<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use InvModels\SharedModels\ClinicianAdjustments;
use InvModels\SharedModels\Entity;
use InvModels\SharedModels\State;
use InvModels\SharedModels\CPTCodes;
use InvModels\SharedModels\User;
use InvModels\SharedModels\ClinicianCompensation;
use InvModels\SharedModels\ClinicianCompensationDetails;
use InvModels\SharedModels\ClinicianCompensationSummary;

class FFSController extends Controller
{
    public function CodeList()
    {
        $codes = CPTCodes::all();

        return view("FFS.CPTCodeList", compact('codes'));
    }

    public function saveCPTCode(Request $request)
    {
        CPTCodes::create([
            'index' => $request->index,
            'CPT' => $request->code,
            'SHORT DESCRIPTION' => $request->shortdescription,
            'Type' => $request->type,
            'EM/Procedure' => $request->procedure,
            'InsertTimeStamp' => \Carbon\Carbon::now()
        ]);

        return back();
    }

    public function EntityList()
    {
        $entity = Entity::all();
        $state = State::all();
        return view("FFS.EntityList", compact(['entity', 'state']));
    }

    public function saveEntity(Request $request)
    {
        Entity::create([
            'index' => $request->index,
            'Entity' => $request->entity,
            'State' => $request->state,
            'InsertTimeStamp' => \Carbon\Carbon::now()
        ]);

        return back();
    }

    public function CompensationDocument(Request $request)
    {
        // $clinicianadjustment = ClinicianAdjustments::where([
        //     ["ServiceFrom", $request->fromdate],
        //     ["ServiceEnd", $request->todate],
        //     ["UserId", $request->id]
        // ])->with('adjustments')->get();
        $clinicianadjustment = DB::select("select sum(ca.Amount) as Amount, fa.Description
                                        FROM tblClinicianAdjustments ca
                                        join tblFFSAdjustments fa on ca.AdjustmentId = fa.Id
                                        where ca.UserId = " . $request->id . "
                                         AND ca.ServiceFrom >= '" . $request->fromdate . "'
                                         and ca.ServiceEnd <= '" . $request->todate . "'  group by ca.AdjustmentId, fa.Description");
        $ffs = DB::select("call FFS_Cal_details('" . $request->fromdate . "','" . $request->todate . "'," . $request->id . ");");

        $pdf = PDF::loadView('FFS.CompensationDocument', compact(['ffs', 'clinicianadjustment']));
        return $pdf->stream();
    }

    public function Compensation(Request $request)
    {
        $allmonths = DB::select("SELECT Concat(MONTHNAME(now()), ' - ', YEAR(NOW())) as MonthYear,
                                DATE_FORMAT(date_add(date_add(LAST_DAY(NOW()),interval 1 DAY),interval -1 MONTH), '%Y-%m-%d') AS FIRSTDAY, DATE_FORMAT(LAST_DAY(NOW()), '%Y-%m-%d') AS LASTDAY
                            UNION
                            SELECT Concat(MONTHNAME(now() - INTERVAL 1 MONTH), ' - ', YEAR(NOW() - INTERVAL 1 MONTH)),
                                date_add(date_add(LAST_DAY(NOW() - INTERVAL 1 MONTH),interval 1 DAY),interval -1 MONTH) AS FIRSTDAY, LAST_DAY(NOW() - INTERVAL 1 MONTH) AS LASTDAY
                            UNION
                            SELECT Concat(MONTHNAME(now() - INTERVAL 2 MONTH), ' - ', YEAR(NOW() - INTERVAL 2 MONTH)),
                                date_add(date_add(LAST_DAY(NOW() - INTERVAL 2 MONTH),interval 1 DAY),interval -1 MONTH) AS FIRSTDAY, LAST_DAY(NOW() - INTERVAL 2 MONTH) AS LASTDAY
                            UNION
                            SELECT Concat(MONTHNAME(now() - INTERVAL 3 MONTH), ' - ', YEAR(NOW() - INTERVAL 3 MONTH)),
                                date_add(date_add(LAST_DAY(NOW() - INTERVAL 3 MONTH),interval 1 DAY),interval -1 MONTH) AS FIRSTDAY, LAST_DAY(NOW() - INTERVAL 3 MONTH) AS LASTDAY
                            UNION
                            SELECT Concat(MONTHNAME(now() - INTERVAL 4 MONTH), ' - ', YEAR(NOW() - INTERVAL 4 MONTH)),
                                date_add(date_add(LAST_DAY(NOW() - INTERVAL 4 MONTH),interval 1 DAY),interval -1 MONTH) AS FIRSTDAY, LAST_DAY(NOW() - INTERVAL 4 MONTH) AS LASTDAY
                            UNION
                            SELECT Concat(MONTHNAME(now() - INTERVAL 5 MONTH), ' - ', YEAR(NOW() - INTERVAL 5 MONTH)),
                                date_add(date_add(LAST_DAY(NOW() - INTERVAL 5 MONTH),interval 1 DAY),interval -1 MONTH) AS FIRSTDAY, LAST_DAY(NOW() - INTERVAL 5 MONTH) AS LASTDAY");
        $newstart = new \Carbon\Carbon('first day of this month');
        $newend = new \Carbon\Carbon('last day of this month');

        if (!empty($request->period)) {
            $arr = explode('|', $request->period);
            $start = \Carbon\Carbon::parse($arr[0]);
            $end = \Carbon\Carbon::parse($arr[1]);
        } else {
            $start = $newstart->format('Y-m-d');
            $end = $newend->format('Y-m-d');
        }

        $ffs = DB::select("call FFS_Cal('" . $start . "','" . $end . "',0);");
        $userid = \Illuminate\Support\Facades\Auth::user()->id;
        $roleid = \Illuminate\Support\Facades\Auth::user()->roleid;

        return view('FFS.Index', compact(['allmonths', 'ffs', 'userid', 'roleid']))
            ->with([
                'period' => $request->period
            ]);;

    }

    public function FFSDetails($id)
    {
        $ffs = DB::select("SELECT DATE_FORMAT(cd.PayPeriodStart,'%m/%d/%Y')StartDate,DATE_FORMAT(cd.PayPeriodEnd,'%m/%d/%Y')EndDate,
                                        CONCAT(p.PhysicianFName,' ',p.PhysicianLName)Physician,cd.Revenue,cd.Encounters
                        From tblClinicianCompensation cd
                        JOIN tbl_Physician p ON p.PhysicianID = cd.PhysicianId
                        WHERE cd.PhysicianId = " . $id);
        //dd($ffs);
        $details = DB::select("SELECT CONCAT(p.PatientFName,' ',p.PatientLName)PatientName,p.PatientNumber,
                                cd.CPTCode,DATE_FORMAT(cd.DOS,'%m/%d/%Y')DOS,Amount
                                From tblClinicianCompensationDetails cd
                                JOIN tbl_Patient p ON p.PatientID = cd.PatientId
                                WHERE cd.ClinicianId = " . $id);
        return view('FFS.Details', compact(['details', 'ffs']));
    }

    public function FFSDetailsPDF(Request $request){
        $ffs = DB::select("call FFS_Cal_Details('" . $request->fromdate . "','" . $request->todate . "'," . $request->id . ");");
        
        //return view("FFS.Revenue", compact("ffs"));

        $pdf = Pdf::loadView('FFS.Details', compact('ffs'));
        return $pdf->stream();
        //return view('FFS.Details', compact(['details', 'ffs']));
    }

    public function RevenueDetails(Request $request){
        $ffs = DB::select("call FFS_Cal_Details('" . $request->fromdate . "','" . $request->todate . "'," . $request->id . ");");

        return view("FFS.Revenue", compact("ffs"))
        ->with([
                'fromdate' => $request->fromdate,
                'todate' => $request->todate,
                'id' => $request->id
            ]);
    }

    public function EmailDocuments(Request $request){
        $user = User::find($request->data);

        $clinicianadjustment = DB::select("select sum(ca.Amount) as Amount, fa.Description
                                            FROM tblClinicianAdjustments ca
                                            join tblFFSAdjustments fa on ca.AdjustmentId = fa.Id
                                            where ca.UserId = " . $request->data . "
                                            AND ca.ServiceFrom >= '" . $request->fromdate . "'
                                            and ca.ServiceEnd <= '" . $request->todate . "'  group by ca.AdjustmentId, fa.Description");
        $ffs = DB::select("call FFS_Cal('" . $request->fromdate . "','" . $request->todate . "'," . $request->data . ");");

        $matchThese = [
            ["PhysicianId" , "=",  $request->data],
            ["PayPeriodStart", ">=", $request->fromdate],
            ["PayPeriodEnd", "<=", $request->todate]
        ];
                    
        if($request->IsEmail == "true"){
            $pdf = PDF::loadView('FFS.CompensationDocument', compact(['ffs', 'clinicianadjustment']));
        
            $monthname = \Carbon\Carbon::createFromFormat('Y-m-d', $request->fromdate)->format("F");
            $data = array(
                'email_address'=>$user->email,
                'subject'=>"Your " . $monthname . " month FFS",
                'month' => $monthname
            );
        
            Mail::send('emails.FFSDocument', $data, function($message) use($data, $pdf, $monthname) {
                $message->from('no-reply@pinnaclewoundmanagement.com');
                $message->to($data['email_address']);
                $message->subject($data['subject']);
                $message->attachData($pdf->output(), $monthname . "_FFS.pdf");
            });

            ClinicianCompensation::updateOrCreate($matchThese, [
                "PhysicianId" => $request->data,
                "PayPeriodStart" => \Carbon\Carbon::parse($request->fromdate),
                "PayPeriodEnd" => \Carbon\Carbon::parse($request->todate),
                "EMailDate" => \Carbon\Carbon::now()
            ]);
        }
        else{
            $adjustments = collect($clinicianadjustment)->sum("Amount");
            $encounters = collect($ffs)->sum("Count");
            $revenue = collect($ffs)->sum("Clinician_FFS_Owed");

            ClinicianCompensation::updateOrCreate($matchThese, [
                "PhysicianId" => $request->data,
                "PayPeriodStart" => \Carbon\Carbon::parse($request->fromdate),
                "PayPeriodEnd" => \Carbon\Carbon::parse($request->todate),
                "Adjustments" => $adjustments,
                "Encounters" => $encounters,
                "Revenue" => $revenue,
                "Locked" => true,
                "LockedDate" => \Carbon\Carbon::now()
            ]);

            ClinicianCompensationSummary::where([
                ["FromDate", ">=", $request->fromdate],
                ["ToDate", "<=", $request->todate],
                ["user_id", "=", $request->data]
            ])->delete();

            foreach($ffs as $f){
                ClinicianCompensationSummary::insert([
                    "Physician" => $f->Physician,
                    "CPT" => $f->CPT,
                    "Count" => $f->Count,
                    "Amount" => $f->Amount,
                    "Clinician_Amt_MA" => $f->Clinician_Amt_MA,
                    "Clinician_FFS_Owed" => $f->Clinician_FFS_Owed,
                    "Amount_Unit" => $f->Amount_Unit,
                    "ProcessedOn" => $f->ProcessedOn,
                    "FromDate" => $f->FromDate,
                    "ToDate" => $f->ToDate,
                    "user_id" => $f->user_id,
                    "Entity" => $f->Entity 
                ]);
            }
            
            // ClinicianCompensationDetails::where([
            //     ["PeriodStart", ">=", $request->fromdate],
            //     ["PeriodEnd", "<=", $request->todate],
            //     ["ClinicianId", "=", $request->data]
            // ])->delete();
            
            // $ffsdetails = DB::select("call FFS_Cal_Details('" . $request->fromdate . "','" . $request->todate . "'," . $request->data . ");");
            
            // foreach($ffsdetails as $f){
            //     ClinicianCompensationDetails::insert([
            //         "PatientId" => $f->MRnumber,
            //         "VisitId" => $f->Visit_ID,
            //         "ClinicianId" => $f->user_id,
            //         "FacilityId" => $f->Facility,
            //         "CPTCode" => $f->CPT,
            //         "Modifiers" => $f->MOD,
            //         "PeriodStart" => \Carbon\Carbon::parse($request->fromdate),
            //         "PeriodEnd" => \Carbon\Carbon::parse($request->todate),
            //         "DOS" => $f->DOS,
            //         "Amount" => $f->Clinician_FFS_Owed,
            //         "Quantity" => 1
            //     ]);
            // }
        }        
    
        return response()->json([
            "Physician" => $user->firstname . ' ' . $user->lastname,
            "Id" => $user->id
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}