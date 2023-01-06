<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ResidentsExport;
use App\Exports\FamilyExport;
use App\Exports\TemplateExport;
use App\Imports\ResidentsImport;

use Maatwebsite\Excel\Facades\Excel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

use App\Models\ActivityLog;
use App\Models\Barangay;
use App\Models\File;
use App\Models\Resident;
use Illuminate\Support\Facades\Session;


class ResidentImportController extends Controller
{       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportResident(Request $request) 
    {
        $new_log_activity = new ActivityLog();
        $new_log_activity->id = floor(time()-999999999);
        $new_log_activity->user_id = auth()->user()->id;
        $new_log_activity->name = auth()->user()->name;
        $new_log_activity->module = "Resident";
        $new_log_activity->action = "Downloaded Resident List";
        $new_log_activity->url = url()->current();
        $new_log_activity->ip = request()->ip();
        $new_log_activity->agent = $request->header('User-Agent');
        $new_log_activity->save();

        return Excel::download(new ResidentsExport, 'Residents.xlsx');   
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importResident(Request $request) 
    {
        date_default_timezone_set('Asia/Manila');
        
        //Handle File Upload
        if($request->hasFile('file'))
        {
            //How to get a  file name with the Extension
            $filenameWihtExt = $request->file('file')->getClientOriginalName();
            //Get just the filename
            $filename  = pathinfo($filenameWihtExt, PATHINFO_FILENAME);
            //Get just the extension
            $extension = $request->file('file')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload  the image
            $request->file('file')->storeAs('public/files   ', $fileNameToStore);
            //Storage::disk('public')->putFileAs('files',$request->file('file'), $fileNameToStore);
    
            //Storage::disk('public')->put('cover_images', $request->file('cover_image'));
            //php artisan storage:link to link the storage directory into public directory
        }
        
        $import = Excel::import(new ResidentsImport,request()->file('file'));

        if($import)
        {
            //Files
            $new_file = new File();
            $new_file->id = floor(time()-999999999);
            $new_file->file_name = $fileNameToStore;
            $new_file->name = request('fullname');
            $new_file->save();

            //Activity Log
            $new_log_activity = new ActivityLog();
            $new_log_activity->id = floor(time()-999999999);
            $new_log_activity->user_id = auth()->user()->id;
            $new_log_activity->name = auth()->user()->name;
            $new_log_activity->module = "Resident";
            $new_log_activity->action = "File Imported - Resident";
            $new_log_activity->url = url()->current();
            $new_log_activity->ip = request()->ip();
            $new_log_activity->agent = $request->header('User-Agent');
            $new_log_activity->save();
        }

        
        
        return back();
        //return back()->with('success', 'Importado con éxito!');
    }
}