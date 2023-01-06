<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Barangay;
use App\Models\Resident;
use App\Models\ResidentSector;
use App\Models\Sector;
use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\UpdateResidentRequest;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ResidentController extends Controller
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
    public function index(Request $request)
    {
        if (!Session::has('locked'))
        {
            if(auth()->user()->usertype != 'barangay')
            {
                $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->where('residents.status', '=', 1)
                                ->select('residents.*', 'residents.id as resID', 'barangays.*', 'barangays.barangay as brgy', DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                ->get();
                
            }
            else
            {
                $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->where('residents.status', '=', 1)
                                ->where('barangays.barangay', '=', auth()->user()->barangay)
                                ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy', DB::raw('(year(curdate())-year(residents.birth_date)) as age, DATE_FORMAT(residents.birth_date, "%M %d, %Y") as birth'))
                                ->get();
            }

            $brgy = Barangay::all();
            $sector = Sector::all();

            $data = $request->all();

            if(!empty($request->get('findHousehold')) )
            {
                $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                        ->where('residents.status', '1')
                        ->where('residents.household_no', 'LIKE', '%'.$request->get('findHousehold').'%')
                        ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy')
                        ->get();
            }
            
            if(!empty($request->get('findMe')) )
            {
                $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                        ->where('residents.status', '1')
                        ->where('residents.id', $request->get('findMe'))
                        ->orWhere('residents.lastname', $request->get('findMe'))
                        ->orWhere('residents.firstname', $request->get('findMe'))
                        ->orWhere('residents.middlename', $request->get('findMe'))
                        ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy')
                        ->get();
            }
            
            if(!empty($request->get('gender')) )
            {
                $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                        ->where('residents.status', '1')
                        ->where('residents.gender', $request->get('gender'))
                        ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy')
                        ->get();
            }
            
            if(!empty($request->get('findSctr')) )
            {
                $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                        ->join('resident_sectors', 'resident_sectors.resident_id', '=', 'residents.id')
                        ->where('residents.status', '1')
                        ->where('resident_sectors.sector_id', $request->get('findSctr'))
                        ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy')
                        ->get();
            }
            
            if(!empty($request->get('findSitio')) )
            {
                $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                        ->where('residents.status', '1')
                        ->where('residents.sitio', $request->get('findSitio'))
                        ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy')
                        ->get();
            }
            
            if(!empty($request->get('findBrgy')) )
            {
                $res = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                        ->where('residents.status', '1')
                        ->where('residents.barangay_id', $request->get('findBrgy'))
                        ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy')
                        ->get();
            }

            return view('residents.index', compact('data', 'res', 'brgy', 'sector'));
        }
        else
        {
            return redirect('/locked');
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
     * @param  \App\Http\Requests\StoreResidentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

            //Resident Personal Information
            $new_resident = new Resident();

            if(Auth::user()->usertype == 'admin')
            {
                $barangay = $request['barangay'];
            }
            elseif(Auth::user()->usertype == 'barangay')
            {
                $item = Barangay::where('barangay', Auth()->user()->barangay)->select('barangays.id')->get();
                foreach($item as $value)
                $barangay = $value->id;
            }
                $new_resident->household_no = $request['household_no'];
                $new_resident->lastname = strtoupper($request['lastname']);
                $new_resident->firstname = strtoupper($request['firstname']);
                $new_resident->middlename = strtoupper($request['middlename']);
                $new_resident->suffix = strtoupper($request['suffix']);
                $new_resident->birth_date = $request['birth_date'];
                $new_resident->gender = strtoupper($request['gender']);
                $new_resident->phone_number = $request['phone_number'];
                $new_resident->sitio = strtoupper($request['sitio']);
                $new_resident->barangay_id = $barangay;
                $new_resident->save();
            
                //New Log
                $new_log_activity = new ActivityLog();
                $new_log_activity->id = floor(time()-999999999);
                $new_log_activity->user_id = auth()->user()->id;
                $new_log_activity->name = auth()->user()->name;
                $new_log_activity->module = "Resident";
                $new_log_activity->action = "Added new Resident - " . ucfirst(request('lastname')) .', '. ucfirst(request('firstname'));
                $new_log_activity->url = url()->current();
                $new_log_activity->ip = request()->ip();
                $new_log_activity->agent = $request->header('User-Agent');
                $new_log_activity->save();
                
                //success, error, info, warning
                Toastr::success(strtoupper(request('lastname')) . ' ' . strtoupper(request('firstname')) . ' Added Successfully :)','Success');
                
                return back()->with('success', 'User created successfully.');
                //return back()->with('success', 'Importado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        date_default_timezone_set('Asia/Manila');

        if (!Session::has('locked'))
        {
            $resident = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')->where('residents.id', $id)
                                ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy')
                                ->first();

            $resident_sector = Sector::join('resident_sectors', 'resident_sectors.sector_id', '=', 'sectors.id')
                                        ->where('resident_sectors.resident_id', $id)
                                        ->get();
            
            return view('residents.show', compact('resident', 'resident_sector'));
        }
        else
        {
            return redirect('/locked');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        date_default_timezone_set('Asia/Manila');

        if (!Session::has('locked'))
        {    
            $resident = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')->where('residents.id', $id)
                                ->select('residents.*', 'residents.id as resID', 'barangays.barangay as brgy')
                                ->first();
            
            $sectors = Sector::all();

            $resident_sector = ResidentSector::where('resident_id', $id)
                                                        ->pluck('sector_id')
                                                        ->all();
            
            return view('residents.edit', compact('resident', 'sectors', 'resident_sector'));
        }
        else
        {
            return redirect('/locked');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResidentRequest  $request
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');

        $sector_ids = ($request->get('sectors'));

        //
        
        if(!empty($sector_ids))
        {
            for($i=0; $i<count($sector_ids); $i++)
            {
                //Insert
                if(!ResidentSector::where('resident_id', $id)->where('sector_id', $sector_ids[$i])->exists())
                {
                    $new_resident_sector = new ResidentSector();
                    $new_resident_sector->resident_id = $id;
                    $new_resident_sector->sector_id = $sector_ids[$i];
                    $new_resident_sector->save();

                }
            }   
            //success, error, info, warning
            Toastr::info('Sector Successfully Update :)','Success');
        }

        $resident_update = Resident::find($id);
        $resident_update->firstname = strtoupper(request('firstname'));
        $resident_update->middlename = strtoupper(request('middlename'));
        $resident_update->lastname = strtoupper(request('lastname'));
        $resident_update->gender = strtoupper(request('gender'));
        $resident_update->birth_date = request('birth_date');
        $resident_update->phone_number = request('phone_number');
        $resident_update->save();

        //New Log
        $new_log_activity = new ActivityLog();
        $new_log_activity->id = floor(time()-999999999);
        $new_log_activity->user_id = auth()->user()->id;
        $new_log_activity->name = auth()->user()->name;
        $new_log_activity->module = "Resident";
        $new_log_activity->action = "Update Resident Information - " . ucfirst(request('lastname')) .', '. ucfirst(request('firstname'));
        $new_log_activity->url = url()->current();
        $new_log_activity->ip = request()->ip();
        $new_log_activity->agent = $request->header('User-Agent');
        $new_log_activity->save();

        //success, error, info, warning
        Toastr::info('Personal Information Successfully Update :)','Success');
        

        return back();
    }

    public function changeBrgy(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $change_brgy = Resident::find($request->res_id);

        if(!empty($request->barangay))
        {
            if($change_brgy->barangay_id == $request->barangay)
            {
                //success, error, info, warning
                Toastr::info('No changes was made :)','Warning');
                
                return back();
                //return back()->with('success', 'Importado con éxito!');
            }
            else
            {
                $change_brgy->barangay_id = $request->barangay;
                $change_brgy->save();

                //New Log
                $new_log_activity = new ActivityLog();
                $new_log_activity->id = floor(time()-999999999);
                $new_log_activity->user_id = auth()->user()->id;
                $new_log_activity->name = auth()->user()->name;
                $new_log_activity->module = "Resident";
                $new_log_activity->action = "Address Change - " . $change_brgy->lastname .', '. $change_brgy->firstname;
                $new_log_activity->url = url()->current();
                $new_log_activity->ip = request()->ip();
                $new_log_activity->agent = $request->header('User-Agent');
                $new_log_activity->save();

                //success, error, info, warning
                Toastr::success('Address Changed Successfully :)','Success');
                
                return back();
                //return back()->with('success', 'Importado con éxito!');
            }
        }
        else
        {
            //success, error, info, warning
            Toastr::warning('Please Select Barangay :)','Warning');
            
            return back();
            //return back()->with('success', 'Importado con éxito!');
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');
        
        $res_del = Resident::find($request->res_id);
    
        //New Log
        $new_log_activity = new ActivityLog();
        $new_log_activity->id = floor(time()-999999999);
        $new_log_activity->user_id = $id;
        $new_log_activity->name = auth()->user()->name;
        $new_log_activity->module = "Resident";
        $new_log_activity->action = $res_del->lastname ." " .$res_del->firstname. " deleted as Resident";
        $new_log_activity->url = url()->current();
        $new_log_activity->ip = request()->ip();
        $new_log_activity->agent = $request->header('User-Agent');
        $new_log_activity->save();
        
        //success, error, info, warning
        Toastr::error($res_del->lastname ." " .$res_del->firstname. ' successfully deleted as resident :)','Success');

        $res_del->delete();

        return back();
  
    }

    //Not Wotking
    public function deleteAll(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        Resident::whereIn('id', $request->get('selected'))->delete();

        return response("Selected resident(s) deleted successfully.", 200);
    }
}