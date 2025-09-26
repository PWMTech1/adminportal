<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use InvModels\SharedModels\Visit;
use InvModels\SharedModels\File;
use App\User;

class VisitController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'GetProgressNotePDF']);
    }

    public function index(Request $request)
    {
        $fromdate = empty($request->get('fromdate')) ? \Carbon\Carbon::now()->startOfWeek()->format('m/d/Y') : $request->get('fromdate');
        $todate = empty($request->get('todate')) ? \Carbon\Carbon::now()->now()->format('m/d/Y') : $request->get('todate');
        $physicianid = $request->get('clinician');
        $facilityid = $request->get('facility');
       
//        dd($facilityid);
        $clinicians = DB::select("SELECT p.PhysicianID,CONCAT(p.PhysicianFName,' ',p.PhysicianLName)Clinician
                                    FROM tbl_Physician p
                                    WHERE recActive = 'True' AND WoundCare = 'True'
                                             ORDER BY 2;");
        $facilities = DB::select("SELECT c.Idnumber,c.codeValue FROM tbl_CODE_ComponentofCare c
                        JOIN tbl_ComponentOfCareInfo com
                                ON c.Idnumber = com.ComponentOfCareCode AND recActive = 1
                        ORDER BY c.codeValue;");
        $visits = DB::select("call GetVisits(" . (empty($physicianid) ? "0" : $physicianid) . "," . (empty($facilityid) ? "0" : $facilityid) .",'" . $fromdate . "','" . $todate . "')");
        //dd($visits);
        return view('Visit.Index',compact(['visits','clinicians','facilities','fromdate','todate','physicianid','facilityid']));
    }
    

    public function GetPayerTotals(){
        $data = \Illuminate\Support\Facades\DB::select("SELECT COUNT(*)y,CASE WHEN MI.CustomSortOrder NOT IN(3,13,8) THEN 'Commercial'
                                                            WHEN MI.CustomSortOrder = 3 THEN 'Medicaid'
                                                            WHEN MI.CustomSortOrder = 13 THEN 'Medicare'
                                                            WHEN MI.CustomSortOrder = 8 THEN 'SelfPay' END name
                                                        FROM tbl_PatientInsurance PI
                                                        JOIN tbl_Insurance i ON PI.InsuranceID = i.InsuranceID
                                                        JOIN tbl_CODE_MasterInsurances MI ON MI.Code = i.MasterInsuranceID
                                                        WHERE PolicySeq = 1
                                                        GROUP BY
                                                        (
                                                        CASE WHEN MI.CustomSortOrder NOT IN(3,13,8) THEN 'Commercial'
                                                                                        WHEN MI.CustomSortOrder = 3 THEN 'Medicaid'
                                                                                        WHEN MI.CustomSortOrder = 13 THEN 'Medicare'
                                                                                        WHEN MI.CustomSortOrder = 8 THEN 'SelfPay' END
                                                        )");
        return response()->json(['series' => $data]);
    }
    
    public function ViewReviewedVisits(Request $request){
        $procedure = "GetReviewedVisits";
        $clinician = 0;

        if (!empty($request->clinician))
            $clinician = $request->clinician;

        $patients = DB::select("call " . $procedure . "(" . $clinician . "," . 
                (empty($request->fromdate) ? 'null' : "'" . $request->fromdate . "'")
            . "," . (empty($request->todate) ? 'null' : "'" . $request->todate . "'") . ");");

        $page = request('page', 1);
        $pageSize = 20;
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($patients, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($patients), $pageSize, $page, ['path' => url('/Visit/Reviewed?clinician=' . $clinician . '&fromdate=' . $request->fromdate .
            '&todate=' . $request->todate)]);

        $users = User::where("roleid", "10")->orderBy("firstname")->get();

        return view("Visit.ViewReviewedVisits", compact(['paginator', 'users']))
            ->with([
                'fromdate' => (empty($request->fromdate) ? '' : $request->fromdate),
                'todate' => (empty($request->todate) ? '' : $request->todate),
                'clinician' => $clinician
            ]);
    }
    
    public function GetMonthCounts() {
        $data = \Illuminate\Support\Facades\DB::select("SELECT date_format(str_to_date(visitDate, '%m/%d/%Y'),'%m') AS MonthNumber,COUNT(*) as Total 
            FROM tbl_Visit
            WHERE date_format(str_to_date(visitDate, '%m/%d/%Y'),'%Y') = 2019
            GROUP BY date_format(str_to_date(visitDate, '%m/%d/%Y'),'%m')");

        $monthnumber = array();
        $total = array();

        foreach ($data as $r) {
            $monthnumber[] = $r->MonthNumber;
            $total[] = $r->Total;
        }
        //dd($monthnumber);
        return response()->json([
                    'labels' => $monthnumber,
                    'series' => $total
        ]);
    }

    public function GetProgressNotePDF($id) {
        $visit = Visit::where('VisitID', $id)->get();
        //dd($visit->first()->wounds[0]->cellulartissue);
        //dd($visit->first()->wounds->first()->cellulartissue);
        if($visit->first()->IsNonVisit){
            $pdf = PDF::loadView("Visit.NonVisitNotes", compact('visit'));
        }
        else{
            $pdf = PDF::loadView('Visit.ProgressNotes', compact('visit'));
        }

        File::where("VisitID", $id)->insert([
            'CreatedAt'=>\Carbon\Carbon::now(),
            'GeneratedFile'=>base64_encode($pdf->output()),
            'Tag'=>'New Visit',
            'VisitID'=>$id
        ]);
        return $pdf->stream();
    }

    public function GetProgressNotes($id) {
        
        $file = File::where("VisitID", (int)$id)->get();
        
        if(empty($file[0]->Blob)){
            $file_contents = base64_decode($file[0]->GeneratedFile);
        }
        else{
            $file_contents = base64_decode($file[0]->Blob, true);
        }
        return response()->json([
            'notes' => $file_contents
        ]);
        
    }

    public function GetGeneratedNotePDF($id){
        $file = File::where("VisitID", $id)->get();
        $pdf = base64_decode($file[0]->GeneratedFile);

        return Response::make($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="test.pdf"'
        ]);
        return $pdf;
    }

}