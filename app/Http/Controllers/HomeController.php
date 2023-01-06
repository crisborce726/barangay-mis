<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use App\Models\Barangay;
use App\Models\BarangayOfficial;
use App\Models\File;
use App\Models\Resident;
use App\Models\ResidentSector;
use App\Models\Sector;
use App\Models\User;

use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth', ['except' => ['welcome']]);
    }
    
    public function welcome()
    {
        if(!Auth::guest())
        {
            return redirect()->route('home');
        }
        else
        {
            return view('welcome');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
                    $users = User::count();
                    $onlineUsers = User::where('online', '1')->count();
                    $residents = Resident::where('residents.status', '=', 1)->count();
                    $files = File::count();
                    $archives = User::where('status', '2')->count();
                    $userlog = ActivityLog::whereDate('created_at', '=', date('Y-m-d'))->count();

                    //1 - Family Head, 2 - Farmer, 3 - Household Head, 4 - OFW, 5 - Out Of School Youth, 6 - PWD, 7 - Senior Citizen, 8 - Solo Parent, 9 - 4Ps
                    //Counting from ResidentSector Table Only
                    $family_heads = ResidentSector::where('sector_id', '=', 20220001)->count();
                    $farmers = ResidentSector::where('sector_id', '=', 20220002)->count();
                    $household_heads = ResidentSector::where('sector_id', '=', 20220003)->count();
                    $ofws = ResidentSector::where('sector_id', '=', 20220004)->count();
                    $osy = ResidentSector::where('sector_id', '=', 20220005)->count();
                    $pwds = ResidentSector::where('sector_id', '=', 20220006)->count();
                    $senior_citizens = ResidentSector::where('sector_id', '=', 20220007)->count();
                    $solo = ResidentSector::where('sector_id', '=', 20220008)->count();
                    $fourps = ResidentSector::where('sector_id', '=', 20220009)->count();
                    $business = ResidentSector::where('sector_id', '=', 20220010)->count();
                    $children = ResidentSector::where('sector_id', '=', 20220011)->count();
                    $women = ResidentSector::where('sector_id', '=', 20220012)->count();

                    //$family_heads = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                    //                                    ->where('resident_sectors.sector_id', '=', 20220001)
                    //                                    ->count();

                    $logs = ActivityLog::orderBy('id', 'DESC')->paginate(5);

                    return view ('home', compact(
                        'users', 
                        'onlineUsers',
                        'residents',
                        'files',
                        'archives', 
                        'userlog',
                        'family_heads',
                        'farmers',
                        'household_heads',
                        'ofws',
                        'osy',
                        'pwds',
                        'senior_citizens',
                        'solo',
                        'fourps',
                        'business',
                        'children',
                        'women',
                        'logs'
                    ));
                }
                //For DSWD
                elseif(Auth::user()->usertype == 'department-dswdo'  ||  Auth::user()->usertype == 'department-mdrrmo')
                {
                    $residents = Resident::where('residents.status', '=', 1)->count();

                    //1 - Family Head, 2 - Farmer, 3 - Household Head, 4 - OFW, 5 - Out Of School Youth, 6 - PWD, 7 - Senior Citizen, 8 - Solo Parent, 9 - 4Ps
                    //1 - Family Head, 2 - Farmer, 3 - Household Head, 4 - OFW, 5 - Out Of School Youth, 6 - PWD, 7 - Senior Citizen, 8 - Solo Parent, 9 - 4Ps
                    //Counting from ResidentSector Table Only
                    $family_heads = ResidentSector::where('sector_id', '=', 20220001)->count();
                    $farmers = ResidentSector::where('sector_id', '=', 20220002)->count();
                    $household_heads = ResidentSector::where('sector_id', '=', 20220003)->count();
                    $ofws = ResidentSector::where('sector_id', '=', 20220004)->count();
                    $osy = ResidentSector::where('sector_id', '=', 20220005)->count();
                    $pwds = ResidentSector::where('sector_id', '=', 20220006)->count();
                    $senior_citizens = ResidentSector::where('sector_id', '=', 20220007)->count();
                    $solo = ResidentSector::where('sector_id', '=', 20220008)->count();
                    $fourps = ResidentSector::where('sector_id', '=', 20220009)->count();
                    $business = ResidentSector::where('sector_id', '=', 20220010)->count();
                    $children = ResidentSector::where('sector_id', '=', 20220011)->count();
                    $women = ResidentSector::where('sector_id', '=', 20220012)->count();

                    $logs = ActivityLog::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(10);

                    return view ('home', compact(
                        'residents',
                        'family_heads',
                        'farmers',
                        'household_heads',
                        'ofws',
                        'osy',
                        'pwds',
                        'senior_citizens',
                        'solo',
                        'fourps',
                        'business',
                        'children',
                        'women',
                        'logs'
                    ));
                }
                //For DA
                elseif(Auth::user()->usertype == 'da')
                {
                    $users = User::count();
                    $logs = ActivityLog::join('users', 'users.id', '=', 'activity_logs.user_id')
                    ->where('users.usertype', auth()->user()->usertype)
                    ->paginate(10);

                    return view ('home', compact('users', 'logs'));
                }
                //For RHU
                elseif(Auth::user()->usertype == 'rhu')
                {
                    $users = User::count();
                    $logs = ActivityLog::join('users', 'users.id', '=', 'activity_logs.user_id')
                    ->where('users.usertype', auth()->user()->usertype)
                    ->paginate(10);

                    return view ('home', compact('users', 'logs'));
                }
                //For Barangay
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $brgy = Barangay::where('barangay', Auth::user()->barangay)->first();

                    $residents = Resident::where('barangay_id', $brgy->id)->count();
                    $officials = BarangayOfficial::count();

                    //1 - Family Head, 2 - Farmer, 3 - Household Head, 4 - OFW, 5 - Out Of School Youth, 6 - PWD, 7 - Senior Citizen, 8 - Solo Parent, 9 - 4Ps, 10 - Business Owener
                    $family_heads = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220001)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $farmers = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220002)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $household_heads = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220003)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $ofws = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220004)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $osy = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220005)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $pwds = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220006)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $senior_citizens = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 2022000)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $solo = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220008)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $fourps = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220009)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $business = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220010)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $children = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220011)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    $women = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220012)
                                                        ->where('barangays.barangay', '=', auth()->user()->barangay)
                                                        ->count();
                    
                    $logs = ActivityLog::join('users', 'users.id', '=', 'activity_logs.user_id')
                    ->where('users.barangay', auth()->user()->barangay)
                    ->paginate(10);

                    return view ('home', compact(
                        'residents',
                        'officials',
                        'family_heads',
                        'farmers',
                        'household_heads',
                        'ofws',
                        'osy',
                        'pwds',
                        'senior_citizens',
                        'solo',
                        'fourps',
                        'business',
                        'children',
                        'women',
                        'logs'
                    ));
                }
                else
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
}