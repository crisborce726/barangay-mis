<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Http\Requests\StoreBarangayRequest;
use App\Http\Requests\UpdateBarangayRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Barangay;
use App\Models\BarangayOfficial;
use App\Models\ResidentSector;

class BarangayController extends Controller
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

    public function brgyNav()
    {
        $bgry = Barangay::all();
        return view('barangays.nav_tab', compact('bgry'));
    }

    public function barangayResidentList ($barangay)
    {
        $bgry = Barangay::all();
        $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->where('residents.status', '=', 1)
                                ->where('barangays.barangay', '=', $barangay)
                                ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy', DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                ->get();
        return view('barangays.lists', compact('res', 'barangay', 'bgry'));
    }

    public function index()
    {
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                if(Auth::user()->usertype != "barangay")
                {
                    $bgry = Barangay::all();
                    return view('barangays.index', compact('bgry'));
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

    public function dashboard($barangay)
    {
        if(!Auth::guest())
        {
            if (!Session::has('locked'))
            {
                if(Auth::user()->usertype != "barangay")
                {
                    $bgry = Barangay::all();
                    $bgryName = "Ap-apaya";

                    $brgy = Barangay::where('barangay', Auth::user()->barangay)->first();

                    $officials = BarangayOfficial::count();

                    //1 - Family Head, 2 - Farmer, 3 - Household Head, 4 - OFW, 5 - Out Of School Youth, 6 - PWD, 7 - Senior Citizen, 8 - Solo Parent, 9 - 4Ps, 10 - Business Owener
                    $family_heads = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220001)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $farmers = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220002)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $household_heads = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220003)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $ofws = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220004)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $osy = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220005)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $pwds = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220006)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $senior_citizens = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 2022000)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $solo = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220008)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $fourps = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220009)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $business = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220010)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $children = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220011)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();
                    $women = ResidentSector::join('residents', 'residents.id', '=', 'resident_sectors.resident_id')
                                                        ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                                        ->where('resident_sectors.sector_id', '=', 20220012)
                                                        ->where('barangays.barangay', '=', $barangay)
                                                        ->count();

                    return view ('barangays.dash', compact(
                        'bgry',
                        'bgryName',
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
                        'women'
                    ));
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
     * @param  \App\Http\Requests\StoreBarangayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function show(Barangay $barangay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function edit(Barangay $barangay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangayRequest  $request
     * @param  \App\Models\Barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangayRequest $request, Barangay $barangay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barangay $barangay)
    {
        //
    }
}