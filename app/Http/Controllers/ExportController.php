<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

use App\Models\Sector;
use App\Models\ActivityLog;
use App\Models\Resident;
use App\Models\Barangay;

class ExportController extends Controller
{
    public function exportExcel(Request $request, $id)
    {
        if (!Session::has('locked'))
        {
            $get = Sector::find($id);
            $get_name = $get->sector;
            $put_name = ucfirst($get_name);

            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "Sector";
            $new_log_activity->action = "Downloaded " . ucfirst($get_name) . " List";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
            $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();

            if(auth()->user()->usertype != 'barangay')
            { 
                //Admin and Department
                //What to extract
                return (new FastExcel(DB::table('residents')
                    ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                    ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                    ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                    ->where('sectors.id', '=', $id)
                    ->get()))->download($put_name . ' '.date('M-d-Y').'.xlsx');
            }
            else
            {
                //Per Barangay
                //What to extract
                return (new FastExcel(DB::table('residents')
                    ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                    ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                    ->join('sectors', 'sectors.id', '=', 'resident_sectors.sector_id')
                    ->where('sectors.id', '=', $id)
                    ->where('barangays.barangay', '=', auth()->user()->barangay)
                    ->get()))->download($put_name . ' '.date('M-d-Y').'.xlsx');

            }
        }
        else
        {
            return redirect('/locked');
        }
    }

    //For admin => Exporting Residents per Barangay
    public function exportBarangayExcel(Request $request, $barangay)
    {
        if (!Session::has('locked'))
        {

            if(auth()->user()->usertype != 'barangay')
            { 
                //Admin and Department
                //What to extract
                //Check if database has Records
                $find = Barangay::where('barangay', $barangay)->get();
              
                $check_db = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->where('barangays.barangay', $barangay)->count();
                    
                
                if($check_db > 0)
                {
                    $download = new FastExcel(DB::table('residents')
                    ->join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                    ->join('resident_sectors', 'residents.id', '=', 'resident_sectors.resident_id')
                    ->where('barangays.barangay', '=', $barangay)
                    ->get());

                    $new_log_activity = new ActivityLog();
                    $new_log_activity->id = floor(time()-999999999);
                    $new_log_activity->user_id = auth()->user()->id;
                    $new_log_activity->name = auth()->user()->name;
                    $new_log_activity->module = "Resident";
                    $new_log_activity->action = "Exported Barangay " . ucfirst($barangay) . " to Excel";
                    $new_log_activity->url = url()->current();
                    $new_log_activity->ip = request()->ip();
                    $new_log_activity->agent = $request->header('User-Agent');
                    $new_log_activity->save();

                    return $download->download($barangay . ' '.date('M-d-Y').'.xlsx');
                }
                else
                {
                    //success, error, info, warning
                    Toastr::info('Nothing to export:)','Warning');
                    return back();
                }
                
            }
            //Unauthorized User
            else
            {
                return view('errors.401');
            }
            
        }
        else
        {
            return redirect('/locked');
        }
    }
}