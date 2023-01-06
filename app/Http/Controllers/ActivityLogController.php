<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Http\Requests\StoreActivityLogRequest;
use App\Http\Requests\UpdateActivityLogRequest;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ActivityLogController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                //For Admin
                if(Auth::user()->usertype == 'admin')
                {   
                    $data_user= User::all();
                    $data = ActivityLog::select('activity_logs.*', DB::raw('DATE_FORMAT(activity_logs.created_at, "%M %d, %Y") as date'))->get();
                    
                    return view ('activity_logs.index', compact('data_user', 'data'));
                }
                //For Department DSWDO
                elseif(Auth::user()->usertype == 'department-dswdo' || Auth::user()->usertype == 'department-mdrrmo')
                {
                    $data = User::join('activity_logs', 'users.id', '=', 'activity_logs.user_id')
                                    ->where('users.usertype', auth()->user()->usertype)
                                    ->select('activity_logs.*', DB::raw('DATE_FORMAT(activity_logs.created_at, "%M %d, %Y") as date'))->get();
                    
                    return view ('activity_logs.index', compact('data'));
                }
                //For Barangay
                elseif(Auth::user()->usertype == 'barangay')
                {
                    
                    $data = User::join('activity_logs', 'users.id', '=', 'activity_logs.user_id')
                                ->where('users.barangay', auth()->user()->barangay)
                                ->select('activity_logs.*', DB::raw('DATE_FORMAT(activity_logs.created_at, "%M %d, %Y") as date'))->get();
                    
                    return view ('activity_logs.index', compact('data'));
                }
                //Error NO PAGE FOUND
                {
                    return view('errors.404');
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

    public function viewLogs(Request $request, $id)
    {
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                //For Admin
                if(Auth::user()->usertype == 'admin')
                {   
                        $user = User::find($id);
                        $get_user = $user->name;
                        $data = ActivityLog::where('user_id', $id)
                                    ->select('activity_logs.*', DB::raw('DATE_FORMAT(activity_logs.created_at, "%M %d, %Y") as date'))->get();

                    return view('activity_logs.view', compact('data', 'get_user'));
                }
                //Error NO PAGE FOUND
                {
                    return view('errors.404');
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
     * @param  \App\Http\Requests\StoreActivityLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityLog  $activityLog
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityLog $activityLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityLog  $activityLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityLog $activityLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityLogRequest  $request
     * @param  \App\Models\ActivityLog  $activityLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityLogRequest $request, ActivityLog $activityLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityLog  $activityLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityLog $activityLog)
    {
        //
    }
}