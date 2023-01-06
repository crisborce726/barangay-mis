<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

use App\Models\ActivityLog;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
  
class UserImportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        $users = User::get();
  
        return view('users', compact('users'));
    }
        
    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportUser() 
    {
        return Excel::download(new UsersExport, 'Users.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importUser(Request $request) 
    {
        Excel::import(new UsersImport,request()->file('file'));

        $new_log_activity = new ActivityLog();
        $new_log_activity->id = floor(time()-999999999);
        $new_log_activity->user_id = auth()->user()->id;
        $new_log_activity->name = auth()->user()->name;
        $new_log_activity->module = "User Account";
        $new_log_activity->action = "File Imported - User Account";
        $new_log_activity->url = url()->current();
        $new_log_activity->ip = request()->ip();
        $new_log_activity->agent = $request->header('User-Agent');
        $new_log_activity->save();
        
        return back();
    }
}