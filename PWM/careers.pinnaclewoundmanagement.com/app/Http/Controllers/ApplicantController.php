<?php

namespace App\Http\Controllers;

use App\Mail\NewApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    public function create(Request $request)
    {
        
        $post = \Illuminate\Support\Facades\DB::table("tbl_Job_Post")->where("id", "=", $request->PostId)->get();
        $applicant = \Illuminate\Support\Facades\DB::table("tbl_Job_Applicants")->insertGetId([
            'Job_ID'=>$post[0]->id,
            'First_Name'=>$request->FirstName,
            'Last_Name'=>$request->LastName,
            'Email'=>$request->Email,
            'Phone_Number'=>$request->Phone,
            'Resume'=> base64_encode(file_get_contents($_FILES['CV']["tmp_name"])),
            'Submitted_At'=> \Carbon\Carbon::now(),
            'FileName'=>$request->FileName,
            'Extension'=>$request->Extension
        ]);
    	
        

        Mail::to($post[0]->Email)->send(new NewApplicant($applicant));

        //return 'Application Received';
    }
}
