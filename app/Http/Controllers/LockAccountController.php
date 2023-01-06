<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;

class LockAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'locked',
            'unlock',
            'forget'
        ]);
    }
    
    public function locked(Request $request)
    {
        Session::put('locked', true);

        $new_log_activity = new ActivityLog();
        $new_log_activity->id = floor(time()-999999999);
        $new_log_activity->user_id = auth()->user()->id;
        $new_log_activity->name = auth()->user()->name;
        $new_log_activity->module = "System Lock";
        $new_log_activity->action = "Screen Locked";
        $new_log_activity->url = url()->current();
        $new_log_activity->ip = request()->ip();
        $new_log_activity->agent = $request->header('User-Agent');
        $new_log_activity->save();

        return view('auth.locked');
    }

    public function unlock(Request $request)
    {
        if ($request->session()->has('locked')) {
            
            $check = Hash::check($request->input('password'), $request->user()->password);

            if (!$check) 
            {
                Toastr::error('Your password does not match your Credential :)','Error');
                return redirect()->route('login.locked');
            }

            // forget login session
            $request->session()->forget('locked');

            Toastr::success('You have successfully retrieve your session:)','Success');
            
            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "System Lock";
            $new_log_activity->action = "Screen Unlock";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
            $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            return redirect('/home');
        }
        
    }
}
