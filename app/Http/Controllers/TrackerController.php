<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DocumentLibrary as ModelsDocumentLibrary;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use InvModels\SharedModels\DocumentLibrary;
use Illuminate\Support\Facades\Response;
use InvModels\SharedModels\Entity;
use InvModels\SharedModels\File;
use App\User;
use Illuminate\Support\Str;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class TrackerController extends Controller
{
    public function UpdatedFacesheet(Request $request){
        DB::select("UPDATE WTAPatient SET UpdateFacesheet = 1 WHERE MRNumber = '" . $request->MRNumber . "'");
    }
    
    public function index(Request $request)
    {
        $procedure = "GetPatientsAndVisits";
        $startdate = \Carbon\Carbon::now();
        $startofmonth = $startdate->firstOfMonth()->format("m/d/Y");
        $endofmonth = $startdate->endOfMonth()->format("m/d/Y");
        $nonvisits = ($request->excludenonvisits == "on" ? "1" : "0");

        $roleid = \Illuminate\Support\Facades\Auth::user()->roleid;
        $clinician = 0;
        if (!empty($request->clinician))
            $clinician = $request->clinician;

        if ($roleid == 1 || $roleid == 10){
            $clinician = \Illuminate\Support\Facades\Auth::user()->id;
        }

        if($roleid == 10){
            $procedure = "GetPatientsAndVisits_New";
        }

        $patients = DB::select("call " . $procedure . "('" . $request->facility . "'," . $clinician . "," . 
                (empty($request->fromdate) ? ($roleid == 10 ? "'" . $startofmonth . "'"  : 'null') : "'" . $request->fromdate . "'")
            . "," . (empty($request->todate) ? ($roleid == 10 ? "'" .  $endofmonth . "'" : 'null') : "'" . $request->todate . "'") . "," .
            ($roleid == 10 ? "1" : $nonvisits) . ",'" . (empty($request->patientname) ? '' : $request->patientname) . "',"
            . ($request->markcompleted == "on" ? "1" : "0") . "," .
            ($request->shownew == "on" ? "1" : "0") . "," . (Str::length($request->entities) == 0 ? "-1" : $request->entities) . ", " .
            ($request->isivr == "on" ? "1" : "0") . ");");

        
        $page = request('page', 1);
        $pageSize = 10;
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($patients, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($patients), $pageSize, $page, ['path' => url('/visitsandpatients?facility=' . $request->facility . '&clinician=' . $clinician . '&fromdate=' . $request->fromdate .
            '&todate=' . $request->todate) . '&patientname=' . $request->patientname . '&markcompleted=' . $request->markcompleted .
            '&excludenonvisits=' . $request->excludenonvisits . '&shownew=' . $request->shownew . "&entities=" . $request->entities]);

        $entity = Entity::all();
        $facilities = DB::select("call GetFacilityList(0, " . $clinician . ")");

        if ($roleid == 2 || $roleid == 7)
            $users = User::where("roleid", "1")->orderBy("firstname")->get();
        else
            $users = User::where([["roleid", "1"], ["id", \Illuminate\Support\Facades\Auth::user()->id]])->get();

        return view("Tracker.VisitsAndPatients", compact(['paginator', 'facilities', 'users', 'entity']))
            ->with([
                'fromdate' => (empty($request->fromdate) ? ($roleid == 10 ? $startofmonth  : '') : $request->fromdate),
                'todate' => (empty($request->todate) ? ($roleid == 10 ? $endofmonth  : '') : $request->todate),
                'facilityname' => $request->facility,
                'clinician' => $clinician,
                'excludenonvisits' => ($roleid == 10 ? "1" : $nonvisits),
                'patientname' => $request->patientname,
                'markcompleted' => $request->markcompleted,
                'shownew' => $request->shownew,
                'entities' => $request->entities,
                'roleid' => $roleid,
                'isivr' => $request->isivr
            ]);
    }

    function generateNewNumber()
    {
        $number = mt_rand(1000000000, 9999999999);

        if ($this->idexists($number)) {
            return $this->generateNewNumber();
        }

        return $number;
    }

    function idexists($number)
    {
        return DocumentLibrary::where('Id', $number)->exists();
    }

    public function SaveReviewed(Request $request){
        DB::update("UPDATE WTAVisit SET Reviewed = 1, ReviewedOn = '" . \Carbon\Carbon::parse($request->DateReviewed)->format('Y-m-d') . "', ReviewedBy = " . \Illuminate\Support\Facades\Auth::user()->id . ", ReviewedNotes = '" . $request->Notes . "', ReviewerSigned = " . $request->Signature . " WHERE VisitId = " . $request->VisitId);
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Chief Complaint','" . $request->CComplaint . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('History and Present Illness','" . $request->History . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Physical Exam','" . $request->Physical . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Consulting with Pt and/or Nurse','" . $request->Nurse . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Follow Up','" . $request->FollowUp . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");

        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Wound location','" . $request->Location . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");

        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Wound Etiology','" . $request->Etiology . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Wound Progress','" . $request->Progress . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Measurements','" . $request->Measurements . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Treatment Plan','" . $request->Treatment . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Procedures','" . $request->Procedures . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Debridements','" . $request->Debridements . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
        DB::update("INSERT INTO WtaChartReview(Section, SectionValue, CreatedDate, VisitId)
                    VALUES('Diagnosis','" . $request->Diagnosis . "','" . \Carbon\Carbon::now() . "'," . $request->VisitId . ");");
    }

    public function uploadfacesheets(Request $request)
    {
        DocumentLibrary::insert([
            'Id' => $this->generateNewNumber(),
            'MRNumber' => $request["MRNumber"],
            'Type' => 'Facesheet',
            'FileName' => $request["filename"],
            'File' => base64_encode($request["data"]),
            'Extension' => $request["type"],
            'DateAdded' => \Carbon\Carbon::now()
        ]);
    }

    public function facesheets($id)
    {
        $file = DocumentLibrary::where("MRNumber", $id)->get();

        $base = trim(explode(",", base64_decode($file[0]->File))[1]);

        if($file[0]->Extension == "jpg")
            file_put_contents($id.".jpg", base64_decode($base, true));
        else
            file_put_contents($id.".pdf", base64_decode($base, true));
        
        $fileurl = public_path()."/".$id.($file[0]->Extension == "jpg" ? ".jpg" : ".pdf");
        
        if(\File::size($fileurl) == 0)
        {
            unlink($fileurl);
            if($file[0]->Extension == "jpg")
                file_put_contents($id.".jpg", base64_decode($base, true));
            else
                file_put_contents($id.".pdf", base64_decode($file[0]->File, true));
        }

        $content = file_get_contents($fileurl);
        unlink($fileurl);
        return Response::make($content, 200, [
            'Content-Type' => ($file[0]->Extension == "jpg" ? 'application/jpg' : "application/pdf"),
            'Content-Length' => strlen($content),
            'Content-Disposition' => 'inline; filename='.($file[0]->Extension == "jpg" ? '"pdf.jpg"' : '"pdf.pdf"')
        ]);
            
    }

    public function UpdateVisitStart(Request $request)
    {
        $mytime = Carbon\Carbon::now()->format('Y-m-d H:i:s');
        DB::update("update WTAVisit SET Start = '" . $mytime . "' WHERE VisitID = " . $request->VisitID);
    }

    public function VisitNotes($id)
    {
        $file = DB::table("WTAFiles")->where("VisitID", "=", (int)$id)->get();

        $file_contents = base64_decode($file[0]->Blob, true);

        return view("Tracker.VisitNotes", compact('file_contents'));
        //
        //        return response($file_contents)
        //            ->header('Cache-Control', 'no-cache private')
        //            ->header('Content-Description', 'File Transfer')
        //            ->header('Content-Type', "application/pdf")
        //            ->header('Content-length', strlen($file_contents))
        //            ->header('Content-Disposition', 'attachment; filename=' . $file[0]->VisitID . ".pdf")
        //            ->header('Content-Transfer-Encoding', 'binary');
        //        return response($file[0]->Blob)
        //        ->withHeaders([
        //            'Content-type: application/pdf',
        //            'Content-Disposition: attachment; filename=' . $file[0]->VisitID
        //        ]);
    }

    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostDescription  $postDescription
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostDescription  $postDescription
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostDescription  $postDescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostDescription  $postDescription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function WoundTrackerApp($visitid)
    {
        //dd($visitid);
        $patinfo = DB::select("call GetPatientVisitInfo(" . $visitid . ")");
        $woundinfo = DB::select("select Etiology,OtherEtiology,Location,OtherLocation,Left_Right,
                                                Anterior_Posterior,Medial_Lateral,Anterior_Dorsal, Proximal_Distal,
                                        WoundStatus,Stage, w.Length / 10 as Length, w.Depth / 10 as Depth, w.Width/10 as Width,
                                        Slough, Eschar, Epithialization, Granulation,ExudateType, ExudateAmount,
                                        Odor,w.Pain,TunnelingPosition,TunnelingDistance,UnderminingStart,UnderminingEnd,
                                        UnderminingDistance,TreatmentPlan,Inferior_Posterior,
                                        Periwound,Color, Moisture, Tissue, Anesthetic, d.Instrument
                                From WTAWound w
                                LEFT JOIN WTADebriment d on w.WoundID = d.WoundID
                                LEFT JOIN WTABiopsy b on b.WoundID = w.WoundID
                                LEFT JOIN WTACautery c on c.WoundID = w.WoundID
                                WHERE w.VisitId = " . $visitid);
        $user = DB::select("select * From users where email = '" . $patinfo[0]->Addedby . "'");
        //dd($user);
        $pdf = PDF::loadView('Tracker.WoundTrackerApp', compact(['patinfo', 'woundinfo', 'user']));
        //dd($pdf);
        return $pdf->stream();
    }

    public function UpdateVisitComplete(Request $request)
    {
        $mytime = Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $visits = explode(",", $request->visits);
        foreach ($visits as $v) {
            DB::update("update WTAVisit SET Completed = 1,CompletedBy = '" . \Illuminate\Support\Facades\Auth::user()->id . "',CompletedOn = '" . $mytime . "' WHERE VisitID = " . $v);
        }
        return response()->json(['Success' => true]);
    }

    public function GetPatientInfo(Request $request)
    {
        $patients = DB::select("select * FROM WTAPatient WHERE MRNumber = '" . $request->PatientNumber . "'");

        return response()->json(['patient' => $patients]);
    }

    public function VisitAllNotes(Request $request)
    {
        $fpdi = PDFMerger::init();
        $arr = explode(",", $request->id);
        $pdf = "";
        foreach ($arr as $a) {
            $file = File::where("VisitID", $a)->get();
            //$pdf = $pdf . base64_decode($file[0]->GeneratedFile, true) . "\r\n";
            file_put_contents($a.".pdf", base64_decode($file[0]->GeneratedFile, true));
            $fpdi->addPDF($a.".pdf");
        }
        $fpdi->merge();
        $output = $fpdi->output();
        
        foreach($arr as $a){
            unlink($a.".pdf");
        }
        return Response::make($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Length' => strlen($output),
            'Content-Disposition' => 'inline; filename="GroupNotes.pdf"'
        ]);
    }

    public function UpdateComplete(Request $request)
    {
        $mytime = Carbon\Carbon::now()->format('Y-m-d H:i:s');
        DB::update("update WTAPatient SET Completed = 1,CompletedBy = '" . \Illuminate\Support\Facades\Auth::user()->id . "',CompletedOn = '" . $mytime . "' WHERE MRNumber = '" . $request->PatientNumber . "'");
        return response()->json(['Success' => true]);
    }

    public function GetTracker($visitid)
    {
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}