<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Banragay;
use App\Models\ResidentSector;
use App\Models\Resident;
use App\Models\Sector;
use App\Http\Requests\StoreResidentSectorRequest;
use App\Http\Requests\UpdateResidentSectorRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;

class ResidentSectorController extends Controller
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
    return view('sectors.index');
    }

    public function sectorNav()
    {
        $sector = Sector::all();
        return view('resident_sector.nav_tab', compact('sector'));
    }

    public function listSector(Request $request, $sector)
    {
        date_default_timezone_set('Asia/Manila');

        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector = Sector::all();
                $sector_id = 20220001;
                $sector = "Family Heads";
                //Family Heads
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    
    //1 - Family Head, 2 - Farmer, 3 - Household Head, 4 - OFW, 5 - Out Of School Youth, 6 - PWD, 7 - Senior Citizen, 8 - Solo Parent, 9 - 4Ps, 10 - Business Owner
    //1 - Family Head
    public function indexFamilyHead(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector_id = 20220001;
                $sector = "Family Heads";
                //Family Heads
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //2 - Farmer
    public function indexFarmer(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector_id = 20220002;
                $sector = "Farmers";
                //Family Heads
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //3 - Household Head
    public function indexHouseholdHead(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector_id = 20220003;
                $sector = "Household Heads";
                //Family Heads
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //4 - OFW,
    public function indexOFW(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector_id = 20220004;
                $sector = "OFW";
                //OFW
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //5 - Out Of School Youth
    public function indexOSY(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector_id = 20220005;
                $sector = "Out of School Youth";
                //OSY
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //6 - PWD
    public function indexPWD(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector_id = 20220006;
                $sector = "PWD";
                //PWD
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //8 - Solo Parent
    public function indexSoloParent(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector_id = 20220008;
                $sector = "Solo Parent";
                //Solo Parent
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //9 - 4Ps
    public function index4Ps(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector_id = 20220009;
                $sector = "4Ps";
                //4Ps
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //10 - Business Owner
    public function indexBusinessOwner(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $sector_id = 20220010;
                $sector = "Business Owner";
                //Business
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //7 - Senior Citizen
    public function indexSeniorCitizen(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $row_senior = Resident::all();
                $sector_id = 20220007;
                $sector = "Senior Citizen";

                //This section can be use by all types of users
                foreach($row_senior as $item_senior)
                {
                    $age = \Carbon\Carbon::parse($item_senior->birth_date)->age;

                    if($age >= 60)
                    {
                        if(!ResidentSector::where('resident_id', $item_senior->id)->where('sector_id', $sector_id)->exists())
                        {
                            $data = array(
                                'resident_id' => $item_senior->id,
                                'sector_id' => $sector_id,
                                'created_at' => now(),
                                'updated_at' => now(),
                                );
                            ResidentSector::insert($data);
                        }
                    }
                }


                //Senior Citizen
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //11 - Children
    public function indexChildren(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $row_children = Resident::all();
                $sector_id = 20220011;
                $sector = "Children";

                //This section can be use by all types of users
                //Auto Inserting of Children aging 0 to 17
                foreach($row_children as $item_children)
                {
                    $age = \Carbon\Carbon::parse($item_children->birth_date)->age;
                    
                    if($age <= 17)
                    {
                        if(!ResidentSector::where('resident_id', $item_children->id)->where('sector_id', $sector_id)->exists())
                        {
                            $data = array(
                                'resident_id' => $item_children->id,
                                'sector_id' => $sector_id,
                                'created_at' => now(),
                                'updated_at' => now(),
                                );
                            ResidentSector::insert($data);
                        }
                    }
                }
                //Auto Inserting of Children aging 0 to 17

                
                //Children
                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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

    //12 - Women
    public function indexWomen(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                $row_data = Resident::all();
                $sector_id = 20220012;
                $sector = "Women";
                //Women
                //This section can be use by all types of users
                //Auto Inserting of Women aging 18 to 59
                foreach($row_data as $item_data)
                {
                    $age = \Carbon\Carbon::parse($item_data->birth_date)->age;

                    if($age >= 18 && $age <= 59 && $item_data->gender == "F")
                    {
                        if(!ResidentSector::where('resident_id', $item_data->id)->where('sector_id', $sector_id)->exists())
                        {
                            $data = array(
                                'resident_id' => $item_data->id,
                                'sector_id' => $sector_id,
                                'created_at' => now(),
                                'updated_at' => now(),
                                );
                            ResidentSector::insert($data);
                    
                        }
                    }
                }
                //Auto Inserting of Women aging 18 to 59  

                if(Auth::user()->usertype !== 'barangay')
                {  
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('sectors.id', '=', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                elseif(Auth::user()->usertype == 'barangay')
                {
                    $res = DB::table('residents')
                                ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                                ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                                ->where('barangays.barangay', auth()->user()->barangay)
                                ->where('resident_sectors.sector_id', $sector_id)
                                ->select(
                                    'residents.*', 
                                    'residents.id as resID', 
                                    'barangays.*', 
                                    'barangays.barangay as brgy',
                                    'resident_sectors.id as resSec_id', 'sectors.id as sector_id', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                    ->get();
                }
                else
                {
                    return view('errors.401');
                }
                return view ('resident_sector.index', compact('res', 'sector_id', 'sector'));
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
     * @param  \App\Http\Requests\StoreResidentSectorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResidentSectorRequest $request)
    {
        date_default_timezone_set('Asia/Manila');

        if (ResidentSector::where('resident_id', '=', $request('resident_id'))->exists() && ResidentSector::where('sector_id', '=', $request('sector_id'))->exists()) 
        {
            // user found
        }
        else
        {
            //success, error, info, warning
            Toastr::warning('Duplicated Entry :)','Warning');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResidentSector  $residentSector
     * @return \Illuminate\Http\Response
     */
    public function show(ResidentSector $residentSector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResidentSector  $residentSector
     * @return \Illuminate\Http\Response
     */
    public function edit(ResidentSector $residentSector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResidentSectorRequest  $request
     * @param  \App\Models\ResidentSector  $residentSector
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResidentSectorRequest $request, ResidentSector $residentSector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResidentSector  $residentSector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        //Resident ID $request->res_id
        $delete_resident = ResidentSector::find($request->res_sec_id);
        $resident = Resident::find($request->res_id);
        $sector = Sector::find($request->sector_id);

        //New Log
        $new_log_activity = new ActivityLog();
        $new_log_activity->id = floor(time()-999999999);
        $new_log_activity->user_id = auth()->user()->id;
        $new_log_activity->name = auth()->user()->name;
        $new_log_activity->module = "Sector";
        $new_log_activity->action = "Delete Resident(Sector) - " . $resident->lastname .', '. $resident->firstname .' as ' . $sector->sector;
        $new_log_activity->url = url()->current();
        $new_log_activity->ip = request()->ip();
        $new_log_activity->agent = $request->header('User-Agent');
        $new_log_activity->save();

        $delete_resident->delete();

        //success, error, info, warning
        Toastr::success('Resident deleted Successfully :)','Success');

        return back();
  
    }

    public function viewHouseholdMember(Request $request, $id)
    {
        if(!Auth::guest())
        {
            if(Auth::user()->usertype != 'barangay')
            {  
                $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->where('residents.household_no', $id)
                                ->select(
                                    'residents.*',
                                    'barangays.barangay as brgy', 
                                    DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                ->get();  
            }
            return view('sectors.member', compact('data'));
        }
        else
        {
            return redirect()->guest('login');
        }
    }

    public function deleteResSec(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $delete_resident = ResidentSector::find($request->res_id);
        $resident = Resident::find($request->id);
        $sector = Sector::find($request->sector_id);

        //New Log
        $new_log_activity = new ActivityLog();
        $new_log_activity->id = floor(time()-999999999);
        $new_log_activity->user_id = auth()->user()->id;
        $new_log_activity->name = auth()->user()->name;
        $new_log_activity->module = "Resident";
        $new_log_activity->action = "Delete Resident(Sector) - " . $resident->lastname .', '. $resident->firstname .' as ' . $sector->sector;
        $new_log_activity->url = url()->current();
        $new_log_activity->ip = request()->ip();
        $new_log_activity->agent = $request->header('User-Agent');
        $new_log_activity->save();

        $delete_resident->delete();

        //success, error, info, warning
        Toastr::success('Resident deleted Successfully :)','Success');

        return back();
    }
}