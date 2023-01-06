<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['status'] = 1;

        return $credentials;
    }
    
    public function username()
    {
        return 'username';
    }

    function authenticated(Request $request, $user)
    {
        date_default_timezone_set('Asia/Manila');

        $request->validate([
            'username'    => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        if (Auth::attempt(['username'=> $username,'password'=> $password,'status'=>'1'])) 
        {
            $user = Auth::User();
            Session::put('user_id', $user->id);
            Session::put('user', $user->name);
            Session::put('barangay', $user->barangay);
            Session::put('usertype', $user->usertype);
            Session::put('username', $user->username);
            Session::put('status', $user->status);
            Session::put('image', $user->image);
            Session::put('online', $user->online);
            Session::put('login_time', (now()));

            $activityLog = 
            [
                'id' => floor(time()-999999999),
                'user_id' => $user->id,
                'name' => $user->name,
                'module' => 'User',
                'action' => 'User Login',
                'url' => url()->current(),
                'ip' => request()->ip(),
                'agent'=> $request->header('User-Agent'),
                'created_at'=> now(),
                'updated_at'=> now()
            ];

            DB::table('activity_logs')->insert($activityLog);

            $online_update = User::find($user->id);
            $online_update->online = 1;
            $online_update->save();

            Toastr::success('Login successfully :)','Success');
        }
        else 
        {
            Toastr::error('fail, WRONG USERNAME OR PASSWORD :)','Error');
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $activityLog = [
            'id' => floor(time()-999999999),
            'user_id' => Session::get('user_id'),
            'name' => Session::get('user'),
            'module' => 'User',
            'action' => 'User Logout',
            'url' => url()->current(),
            'ip' => request()->ip(),
    	    'agent'=> NULL,
            'created_at'=> now(),
		    'updated_at'=> now()
        ];
        DB::table('activity_logs')->insert($activityLog);

        
        $online_update = User::find(Session::get('user_id'));
        $online_update->online = 0;
        $online_update->save();

        // forget login session
        $request->session()->forget('user_id');
        $request->session()->forget('user');
        $request->session()->forget('barangay');
        $request->session()->forget('usertype');
        $request->session()->forget('username');
        $request->session()->forget('status');
        $request->session()->forget('image');
        $request->session()->forget('online');
        $request->session()->forget('login_time');
        $request->session()->forget('locked');
        $request->session()->flush();

        auth()->guard()->logout();
        Toastr::success('Logout successfully :)','Success');
        return redirect('/login');
    }

    
}