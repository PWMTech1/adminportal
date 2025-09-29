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

    public function GetVisitData(Request $request)
    {
        try {
            $visitId = $request->input('visitId');
            
            if (!$visitId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Visit ID is required'
                ], 400);
            }

            // Get visit data with related information
            $visit = DB::select("
                SELECT 
                    v.VisitID, v.MRNumber, v.DOS, 
                    v.PlaceofService, v.DateofAdmission,
                    v.HPIDescription, v.FallRisk,
                    v.TotalFalls, v.ImmunizationType,
                    v.IsDiabetic, v.IsIVR,
                    v.ExamSensation, v.DiabeticNotes, 
                    v.RLERadialPulse, v.LLERadialPulse,
                    v.RLEDorsalisPedis, v.LLEDorsalisPedis,
                    v.RLEEdema, v.LLEEdema, v.Abdomen,
                    v.Obese, v.Hernia, v.BowelSounds,
                    v.RUEDecreaseStrength, v.LUEDecreaseStrength, v.RLEDecreaseStrength, v.LLEDecreaseStrength,
                    v.RUEROM, v.LUEROM, v.RLEROM, v.LLEROM, v.RUEContractures, v.LUEContractures, v.RLEContractures,
                    v.LLEContractures, v.RUESensationIntact, v.LUESensationIntact, v.RLESensationIntact, v.LLESensationIntact,
                    v.Normocephalic, v.EOMIntact, v.FacialDrooping, v.TracheaMidline, v.LungsSound, v.AxillaryNodes,
                    v.Neck, v.OtherArea, v.Groin, v.FollowUpDate, v.Nose, v.Mouth, v.Ears,
                    v.MucousMembrane, v.MinsSpent, v.Signed, v.VitalsBP, v.VitalsTemp,
                    v.VitalsHeight, v.VitalsWeight, v.VitalsResp, v.VitalsPulse, v.FallsType,
                    v.PreventiveMeasures, v.Procedures, v.PreventiveNotes, v.ProviderDiscussion,
                    v.HealingDelayedBy, v.Aid, v.Treatment, v.OrientationAO,
                    v.Judgement, v.Compliant, v.PlanNotes, v.ExamNotes, v.InvestigationNotes,
                    v.AmputationLLE, v.AmputationRLE, v.IsNonVisit, v.NonVisitNotes,
                    v.Puenomia, v.PuenomiaDate, v.PuenomiaReason, v.PulseLLE, v.PulseRLE,
                    v.IsPodiatry, v.IsDermatology, v.Hospice, v.SyncDate, v.Product,
                    CONCAT(p.FirstName, ' ', p.MiddleName, ' ', p.LastName) as PatientName,
                    CONCAT(ph.firstname, ' ', ph.lastname) as ClinicianName,
                    f.Name as FacilityName, f.IsPCC
                FROM WTAVisit v
                LEFT JOIN WTAPatient p ON v.MRNumber = p.MRNumber
                LEFT JOIN users ph ON v.AddedBy = ph.id
                LEFT JOIN tblFacility f ON v.FacilityName = f.Name
                WHERE v.VisitID = ?
            ", [$visitId]);

            if (empty($visit)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Visit not found'
                ], 404);
            }

            $visitData = $visit[0];

            // Format the data for the frontend
            $formattedData = [
                'visitId' => $visitData->VisitID,
                'patientId' => $visitData->MRNumber,
                'facilityId' => $visitData->FacilityName,
                'isPCC' => $visitData->IsPCC == 1,
                'patientName' => $visitData->PatientName,
                'facilityName' => $visitData->FacilityName,
                'dos' => $visitData->DOS,
                'clinician' => $visitData->ClinicianName,
                
                // Basic Visit Information
                'mrNumber' => $visitData->MRNumber,
                'dos' => $visitData->DOS,
                'placeofService' => $visitData->PlaceofService,
                'dateofAdmission' => $visitData->DateofAdmission,
                'hpiDescription' => $visitData->HPIDescription,
                'fallRisk' => $visitData->FallRisk,
                'totalFalls' => $visitData->TotalFalls,
                'immunizationType' => $visitData->ImmunizationType,
                'isDiabetic' => $visitData->IsDiabetic,
                'isIVR' => $visitData->IsIVR,
                'examSensation' => $visitData->ExamSensation,
                'diabeticNotes' => $visitData->DiabeticNotes,
                
                // Pulse and Circulation
                'rleRadialPulse' => $visitData->RLERadialPulse,
                'lleRadialPulse' => $visitData->LLERadialPulse,
                'rleDorsalisPedis' => $visitData->RLEDorsalisPedis,
                'lleDorsalisPedis' => $visitData->LLEDorsalisPedis,
                'rleEdema' => $visitData->RLEEdema,
                'lleEdema' => $visitData->LLEEdema,
                'abdomen' => $visitData->Abdomen,
                'obese' => $visitData->Obese,
                'hernia' => $visitData->Hernia,
                'bowelSounds' => $visitData->BowelSounds,
                
                // Strength and ROM
                'rueDecreaseStrength' => $visitData->RUEDecreaseStrength,
                'lueDecreaseStrength' => $visitData->LUEDecreaseStrength,
                'rleDecreaseStrength' => $visitData->RLEDecreaseStrength,
                'lleDecreaseStrength' => $visitData->LLEDecreaseStrength,
                'rueROM' => $visitData->RUEROM,
                'lueROM' => $visitData->LUEROM,
                'rleROM' => $visitData->RLEROM,
                'lleROM' => $visitData->LLEROM,
                'rueContractures' => $visitData->RUEContractures,
                'lueContractures' => $visitData->LUEContractures,
                'rleContractures' => $visitData->RLEContractures,
                'lleContractures' => $visitData->LLEContractures,
                'rueSensationIntact' => $visitData->RUESensationIntact,
                'lueSensationIntact' => $visitData->LUESensationIntact,
                'rleSensationIntact' => $visitData->RLESensationIntact,
                'lleSensationIntact' => $visitData->LLESensationIntact,
                
                // Head and Neck Exam
                'normocephalic' => $visitData->Normocephalic,
                'eomIntact' => $visitData->EOMIntact,
                'facialDrooping' => $visitData->FacialDrooping,
                'tracheaMidline' => $visitData->TracheaMidline,
                'lungsSound' => $visitData->LungsSound,
                'axillaryNodes' => $visitData->AxillaryNodes,
                'neck' => $visitData->Neck,
                'otherArea' => $visitData->OtherArea,
                'groin' => $visitData->Groin,
                'followUpDate' => $visitData->FollowUpDate,
                'nose' => $visitData->Nose,
                'mouth' => $visitData->Mouth,
                'ears' => $visitData->Ears,
                'mucousMembrane' => $visitData->MucousMembrane,
                
                // Visit Details
                'minsSpent' => $visitData->MinsSpent,
                'signed' => $visitData->Signed,
                'vitalsBP' => $visitData->VitalsBP,
                'vitalsTemp' => $visitData->VitalsTemp,
                'vitalsHeight' => $visitData->VitalsHeight,
                'vitalsWeight' => $visitData->VitalsWeight,
                'vitalsResp' => $visitData->VitalsResp,
                'vitalsPulse' => $visitData->VitalsPulse,
                'fallsType' => $visitData->FallsType,
                'preventiveMeasures' => $visitData->PreventiveMeasures,
                'procedures' => $visitData->Procedures,
                'preventiveNotes' => $visitData->PreventiveNotes,
                'providerDiscussion' => $visitData->ProviderDiscussion,
                'healingDelayedBy' => $visitData->HealingDelayedBy,
                'aid' => $visitData->Aid,
                'treatment' => $visitData->Treatment,
                'orientationAO' => $visitData->OrientationAO,
                'judgement' => $visitData->Judgement,
                'compliant' => $visitData->Compliant,
                'planNotes' => $visitData->PlanNotes,
                'examNotes' => $visitData->ExamNotes,
                'investigationNotes' => $visitData->InvestigationNotes,
                
                // Special Conditions
                'amputationLLE' => $visitData->AmputationLLE,
                'amputationRLE' => $visitData->AmputationRLE,
                'isNonVisit' => $visitData->IsNonVisit,
                'nonVisitNotes' => $visitData->NonVisitNotes,
                'puenomia' => $visitData->Puenomia,
                'puenomiaDate' => $visitData->PuenomiaDate,
                'puenomiaReason' => $visitData->PuenomiaReason,
                'pulseLLE' => $visitData->PulseLLE,
                'pulseRLE' => $visitData->PulseRLE,
                'isPodiatry' => $visitData->IsPodiatry,
                'isDermatology' => $visitData->IsDermatology,
                'hospice' => $visitData->Hospice,
                'syncDate' => $visitData->SyncDate,
                'product' => $visitData->Product
            ];

            return response()->json([
                'success' => true,
                'visit' => $formattedData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading visit data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function SaveVisitChanges(Request $request)
    {
        try {
            $visitId = $request->input('visitId');
            $changes = $request->input('changes');
            
            if (!$visitId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Visit ID is required'
                ], 400);
            }

            if (empty($changes)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No changes to save'
                ], 400);
            }

            // Build update query dynamically based on changes
            $updateFields = [];
            $updateValues = [];
            
            foreach ($changes as $field => $changeData) {
                $updateFields[] = "`{$field}` = ?";
                $updateValues[] = $changeData['new'];
            }
            
            // Add DateModified
            $updateFields[] = "`DateModified` = NOW()";
            
            $updateValues[] = $visitId;
            
            $sql = "UPDATE tbl_Visit SET " . implode(', ', $updateFields) . " WHERE VisitID = ?";
            
            $result = DB::update($sql, $updateValues);
            
            if ($result > 0) {
                // Log the changes for audit trail
                \Log::info("Visit {$visitId} updated with changes: " . json_encode($changes));
                
                return response()->json([
                    'success' => true,
                    'message' => 'Visit notes updated successfully',
                    'changesCount' => count($changes)
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No changes were saved'
                ], 400);
            }

        } catch (\Exception $e) {
            \Log::error('Error saving visit changes: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error saving changes: ' . $e->getMessage()
            ], 500);
        }
    }

}