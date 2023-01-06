<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\User;
use App\Models\UserRole;
use App\Models\ActivityLog;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        //Array portion is for you to except pages.
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                //For Admin
                if(Auth::user()->usertype == 'admin')
                {  
                    date_default_timezone_set('Asia/Manila');
                    
                    $barangay = Barangay::all();
                    $user_roles = UserRole::all();
                    $data = User::all();        
                    return view ('users.index', compact('barangay', 'user_roles', 'data'));
                }
                //Unauthorized User
                {
                    return view('errors.401');
                }
            }
            else
            {
                return redirect('/locked');
            } 
        }
        else
        {
            return redirect()->guest('login');
        }
    }

    //Blocking and Unblocking User Account
    //1 Active
    //0 Block
    public function blockUnblock(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');
          
        $user = User::find($id);
        if($user->status == 0)
        {
            $user->status = 1;
            $user->save();

            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "User Account";
            $new_log_activity->action = $user->name . " Credentials is Activated";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
    	    $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            //success, error, info, warning
            Toastr::success($user->name. ' Credentials is Successfully Activated :)','Success');
        }
        else
        {
            $user->status = 0;
            $user->save();

            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "User Account";
            $new_log_activity->action = $user->name . " Credentials is Blocked";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
    	    $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            //success, error, info, warning
            Toastr::error($user->name. 'Credentials is Successfully Blocked :)','Success');
        }
        
        return back();
        
    }

    //Reseting Password
    public function resetPassword(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');
        
        $user = User::find($id);

        if($user->usertype == 'admin')
        {
            $user->password = Hash::make('admin');
            $user->save();

            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "User Account";
            $new_log_activity->action = $user->name . " Password Reset";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
    	    $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            //success, error, info, warning
            Toastr::success($user->name . ' Reset Password successfully :)','Success');

            return back();
        }
        else
        {
            //Username will be the password after resetting
            $user->password = Hash::make($user->username);
            $user->save();

            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "User Account";
            $new_log_activity->action = $user->name . " Password Reset";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
    	    $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            //success, error, info, warning
            Toastr::success($user->name . ' Reset Password successfully :)','Success');

            return back();
        }
    }

    public function archive(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->usertype =='admin')
        {
            $user = User::Find($request['post_id']);
            $user->status = 2;
            $user->save();
            
            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "User Account";
            $new_log_activity->action = $user->name . " Account Archived";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
    	    $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            //success, error, info, warning
            Toastr::success($user->name . ' credentials has been successfully archived :)','Success');

            return back();
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function restore(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->usertype =='admin')
        {
            $user = User::Find($request['post_id']);
            $user->status = 1;
            $user->save();
            
            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "User Account";
            $new_log_activity->action = $user->name . " Account Restored";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
    	    $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            //success, error, info, warning
            Toastr::success($user->name . ' credentials has been successfully restored :)','Success');

            return back();
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function archiveIndex()
    {
        //For Admin
        if(Auth::user()->usertype == 'admin')
        {
            date_default_timezone_set('Asia/Manila');
            if (!Session::has('locked'))
            {
                $data = User::where('status', '=', '2')->latest()->get();
                return view ('archives.index', compact('data'));
            }
            else
            {
                return redirect('/locked');
            } 
        }
        //Unauthorized User
        {
            return view('errors.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $this->validate($request, [
            'image' => 'image|nullable|max:1999'
        ]);

        if(User::where('username', $request->input('username'))->exists())
        {
            //success, error, info, warning
            Toastr::error('Username is already taken :)','Warning');

            return back();
        }
        else
        {
            //Handle File Upload
            if($request->hasFile('image')){
                //How to get a  file name with the Extension
                $filenameWihtExt = $request->file('image')->getClientOriginalName();
                //Get just the filename
                $filename  = pathinfo($filenameWihtExt, PATHINFO_FILENAME);
                //Get just the extension
                $extension = $request->file('image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Upload  the image
                $request->file('image')->storeAs('public/images', $fileNameToStore);
                //Storage::disk('public')->putFileAs('images',$request->file('image'), $fileNameToStore);
        
                //Storage::disk('public')->put('cover_images', $request->file('cover_image'));
                //php artisan storage:link to link the storage directory into public directory
            }
            else
            {
                $fileNameToStore = 'male.jpg';
            }


            $user = new User();

            $user->name = request('name');
            $user->barangay = request('barangay');
            $user->usertype = request('usertype');
            $user->username = request('username');
            $user->password = Hash::make('Pass_123456');
            $user->status = 1;
            $user->image = $fileNameToStore;
            $user->save();

            //New Log
            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "User";
            $new_log_activity->action = "Added  New User - " . ucfirst(request('name')) .' as '. ucfirst(request('usertype'));
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
            $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();
            
            //success, error, info, warning
            Toastr::success('New user added successfully :)','Success');

            return back();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');

        $this->validate($request, [
            'image' => 'image|nullable|max:2048'
        ]);

        //Handle File Upload
        if($request->hasFile('image'))
        {
            //How to get a  file name with the Extension
            $filenameWihtExt = $request->file('image')->getClientOriginalName();
            //Get just the filename
            $filename  = pathinfo($filenameWihtExt, PATHINFO_FILENAME);
            //Get just the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload  the image
            $request->file('image')->storeAs('public/images', $fileNameToStore);
            //php artisan storage:link to link the storage directory into public directory
        }

        $user = User::find($id);

        if($request->hasFile('image'))
        {
            if($user->image != 'male.jpg')
            {
                //Delete the image
                Storage::delete('public/images/'. $user->image);
            }
            $user->image = $fileNameToStore;
            $user->save();

            //New Log
            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "Profile Image";
            $new_log_activity->action = "Update Profile Image";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
            $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            //success, error, info, warning
            Toastr::success('Image profile has been uploaded successfully :)','Success');
        }
        
        if(auth()->user()->name == request('name') && auth()->user()->username == request('username'))
        {
            return back();            
        }
        elseif(auth()->user()->username == request('username'))
        {
            
            $user->name = request('name');
            $user->save();

            //New Log
            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "Profile";
            $new_log_activity->action = "Update Profile Name";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
            $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            //success, error, info, warning
            Toastr::success('Your  profile has been updated successfully :)','Success');

            return back();
        }
        else
        {
            $request->validate([
                'username' => 'required|string|max:255|unique:users',
            ]);

            $user->name = request('name');
            $user->username = request('username');
            $user->save();

            //New Log
            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "User";
            $new_log_activity->action = "Update Profile Username";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
            $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            //success, error, info, warning
            Toastr::success('Your login credentials has been updated successfully :)','Success');

            return back();
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile($id)
    {
        if(auth()->user()->id == $id)
        {
            $profile = User::find($id);
            return view('profile', compact('profile'));
        }
        else
        {
            return redirect('errors.404');
        }
    }

    public function changePassword(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');

        if(request('new_password') == request('re_new_password'))
        {
            if(Hash::check($request->input('old_password'), auth()->user()->password))
            {
                $user = User::find($id);
                $user->password = Hash::make(request('new_password'));
                $user->save();

                //New Log
                $new_log_activity = new ActivityLog();
                $new_log_activity->id = floor(time()-999999999);
                $new_log_activity->user_id = auth()->user()->id;
                $new_log_activity->name = auth()->user()->name;
                $new_log_activity->module = "User";
                $new_log_activity->action = "Change Password";
                $new_log_activity->url = url()->current();
                $new_log_activity->ip = request()->ip();
                $new_log_activity->agent = $request->header('User-Agent');
                $new_log_activity->save();

                //success, error, info, warning
                Toastr::success('Change Password successfully :)','Success');

                return back();
            }
            else
            {
                //success, error, info, warning
                Toastr::error('Please check your old password :)','Warning');

                return back();

            }
            
        }
        else
        {
            //success, error, info, warning
            Toastr::error('New Password did not match :)','Warning');

            return back();
        }
    }
}