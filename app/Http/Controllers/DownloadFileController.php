<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

use App\Models\File;

class DownloadFileController extends Controller
{
    //Template
    function downloadFile(Request $request)
    {
        if (!Session::has('locked'))
        {
            // $filePath = public_path("storage/files/Template.xlsx");
            $filePath = storage_path("app/public/Template/Template.xlsx");
            if($filePath)
            {
                $new_log_activity = new ActivityLog();
                $new_log_activity->id = floor(time()-999999999);
                $new_log_activity->user_id = auth()->user()->id;
                $new_log_activity->name = auth()->user()->name;
                $new_log_activity->module = "Resident";
                $new_log_activity->action = "Downloaded Template.xlsx";
                $new_log_activity->url = url()->current();
                $new_log_activity->ip = request()->ip();
                $new_log_activity->agent = $request->header('User-Agent');
                $new_log_activity->save();
            }
            return Response::download($filePath);
        }
        else
        {
            return redirect('/locked');
        }
    }

    //Uploaded Files
    function downloadExcelFile(Request $request, $id)
    {
        if (!Session::has('locked'))
        {
            $findFile = File::find($id);
            $filePath = storage_path("app/public/files/$findFile->file_name");
            if($filePath)
            {
                $new_log_activity = new ActivityLog();
                $new_log_activity->id = floor(time()-999999999);
                $new_log_activity->user_id = auth()->user()->id;
                $new_log_activity->name = auth()->user()->name;
                $new_log_activity->module = "Resident";
                $new_log_activity->action = "Downloaded ". $findFile->file_name;
                $new_log_activity->url = url()->current();
                $new_log_activity->ip = request()->ip();
                $new_log_activity->agent = $request->header('User-Agent');
                $new_log_activity->save();
            }
            return Response::download($filePath);
        }
        else
        {
            return redirect('/locked');
        }
    }
}
