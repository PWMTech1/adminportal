<?php

namespace App\Http\Controllers;
use App\Roles;
use App\User;
use App\Facility;
use App\Classes\XCounts;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class PCCController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function OrganizationList(){
        $orgs = DB::select("SELECT * FROM PCCOrganization");
        return view("PCC.OrganizationList", compact('orgs'));
    }
    
    public function SaveOrg(Request $request){
        DB::table("PCCOrganization")->insert([
            'OrgId'=>$request->OrgId,
            'OrgUUID'=>$request->OrgUUID,
            'OrgCode'=>$request->OrgCode,
            'Name'=>$request->OrgName,
            'Enable'=>true
        ]);
    }
    
    public function PatientManagement(){
        $pats = DB::select("SELECT * FROM PCCDuplicatePatients pp JOIN WTAPatient w ON pp.PatientId = w.PCCId WHERE Processed = 0;");
        return view("PCC.PatientManagement", compact("pats"));
    }
    
    public function FacilityDetails($id){
        $facs = DB::select("SELECT * FROM PCCFacility WHERE Id = " . $id);
        return view("PCC.FacilityDetails", compact('facs'));
    }
    
    public function FacilityList(){
        $facs = DB::select("SELECT * FROM PCCFacility");
        return view("PCC.FacilityList", compact('facs'));
    }
    
    public function ReDownloadNoteTypes($facid){
        DB::delete("DELETE p FROM PCCProgressNoteTypes p
                        WHERE p.PCCFacilityId  = " . $facid);
        
        DB::table("PCCFacility")->where("Id", "=", $facid)->update([
            'DownloadedNoteTypes'=>false 
        ]);
    }
    
    public function ReDownloadCategories($facid){
        DB::delete("DELETE p FROM PCCDocumentCategories p
                        WHERE p.Id  = " . $facid);
        
        DB::table("PCCFacility")->where("FacId", "=", $facid)->update([
            'DownloadedCategories'=>false 
        ]);
    }
    
    public function ReDownloadPatients($facid, $autodelete){
        if($autodelete == "true"){
            DB::delete("DELETE pdc FROM PCCAdvanceDirectiveConsents pdc
                        JOIN PCCPatient p ON pdc.PatientId = p.PatientId
                        WHERE p.FacilityId  = " . $facid);
            DB::delete("DELETE pd FROM PCCCoverageDetails pd
                        JOIN PCCCoverages p1 ON pd.CoverageId = p1.CoverageId
                        JOIN PCCPatient p ON p1.PatientId = p.PatientId
                        WHERE p.FacilityId  = " . $facid);
            DB::delete("DELETE pl FROM PCCCoverages pl
                        JOIN PCCPatient p ON pl.PatientId = p.PatientId
                        WHERE p.FacilityId  = " . $facid);
            DB::delete("DELETE pd FROM PCCPatientDiagnosis pd
                        JOIN PCCPatient p ON pd.PatientId = p.PatientId
                        WHERE p.FacilityId = " . $facid);
            DB::delete("DELETE p FROM PCCPractitioners p
                        JOIN PCCPatient p1 ON p.PatientId = p1.PatientId
                        WHERE p1.FacilityId = " . $facid);
            DB::delete("DELETE pa FROM PCCPatientAllergies pa
                        JOIN PCCPatient p ON pa.PatientId = p.PatientId
                        WHERE p.FacilityId = " . $facid);
            DB::delete("DELETE pc FROM PCCPatientContacts pc
                        join PCCPatient p ON pc.PatientId = p.PatientId
                        WHERE p.FacilityId = " . $facid);
            DB::delete("DELETE FROM PCCPatient WHERE FacilityId = " . $facid);
            
            $fac = DB::table("PCCFacility")->where("FacId", "=", $facid)->get();;
            //dd($fac);
//            DB::table("PCCOrganization")->where("OrgUUID", "=", $fac[0]->orgUUID)->update([
//                'Enable'=>true
//            ]);
            DB::table("PCCRedownload")->insert([
                'FacilityId'=>$facid,
                'CreatedAt'=> \Carbon\Carbon::now(),
                'UserId'=>\Illuminate\Support\Facades\Auth::user()->id
            ]);
            
            DB::table("PCCFacility")->where("FacId", $facid)->update([
                'Processed'=>false,
                'ProcessStarted'=>false,
                'ProcessEnded'=>false
            ]);
        }        
        
        $pats = DB::select("SELECT * FROM PCCPatient WHERE FacilityId = " . $facid . ' ORDER BY FirstName;');
        $fac = DB::select("SELECT * FROM PCCFacility WHERE FacId = " . $facid);
        
        $page = request('page', 1);
        $pageSize = 20;
        
        $autodelete = true;
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($pats, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($pats), $pageSize, $page,['path' => url('/pcc/patientlist/' . $facid . '/' . $autodelete)]);
        $reload = $autodelete;
        //dd($paginator);
        return view("PCC.PatientList", compact(['paginator', 'fac', 'facid', 'reload', 'page']));
        
    }
    
    public function PatientList($facid, $reload){
        $fac = DB::select("SELECT * FROM PCCFacility WHERE Id = " . $facid);
        $pats = DB::select("SELECT * FROM PCCPatient WHERE FacilityId = " . $fac[0]->FacId . " AND OrgUUID = '" . $fac[0]->orgUUID . "' ORDER BY LastName;");        
        
        $page = request('page', 1);
        $pageSize = 20;
        
        $autodelete = true;
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($pats, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($pats), $pageSize, $page,['path' => url('/pcc/patientlist/' . $facid . '/' . $reload)]);
                
        //dd($paginator);
        return view("PCC.PatientList", compact(['paginator', 'fac', 'facid', 'reload', 'page']));
    }
    
    public function PatientDetails(Request $request){
        //dd($request->id);
        $pat = DB::table("PCCPatient")->where('PatientId',$request->id)->get();
        $all = DB::table("PCCPatientAllergies")->where("PatientId", $request->id)->get();
        $cov = DB::select("SELECT pd.PayerRank, pd.PayerType, pd.PayerName, pd.IssuerPlanEffectiveDate, pd.IssuerPlanExpirationDate, pd.IssuerName, pd.IssuerPlanName, p.EffectiveFromDateTime FROM PCCCoverageDetails pd
                            JOIN PCCCoverages p ON pd.CoverageId = p.CoverageId
                            WHERE p.PatientId = " . $request->id);
        $dia = DB::select("SELECT * FROM PCCPatientDiagnosis where PatientId = " . $request->id);
        $phy = DB::select("SELECT * FROM PCCPractitioners p WHERE p.PatientId = " . $request->id);
        $con = DB::select("SELECT p.FirstName, p.LastName, p.AddressLine1, p.AddressLine2, City, State, p.PostalCode, p.CellPhone, p.Gender, p.HomePhone, p.Relationship FROM PCCPatientContacts p WHERE p.PatientId = " . $request->id);
        $ad = DB::select("SELECT * FROM PCCAdvanceDirectiveConsents p WHERE p.PatientId = " . $request->id);
        $ob = DB::select("SELECT * FROM PCCPatientVitals WHERE PatientId = " . $request->id);
        $html = view("PCC.PatientDetails", compact(['pat', 'all', 'cov', 'phy', 'dia', 'con', 'ad', 'ob']))->render();
        return response()->json(['success' => true, 'html'=>$html]);
    }
    
    public function Settings(){
        $settings = DB::select("SELECT CustomerKey,SecretKey,OrgUID,OrgID,24HrLimit as DailyLimit, SecLimit FROM PCCSettings");
        return view("PCC.Settings", compact('settings'));
    }
    
    public function PCCLinkFacilityList(Request $request){
        $facs = DB::select("SELECT * FROM tblFacility;");
        $id = $request->id;
        return view("PCC.LinkFacility", compact(["facs", "id"]));
    }
    
    public function PCCLinkNoteTypeList(Request $request){
        $types = DB::select("SELECT * FROM PCCProgressNoteTypes WHERE PCCFacilityId = " . $request->id);
        $id = $request->id;
        return view("PCC.LinkNoteType", compact(["types", "id"]));
    }
    
    public function PCCLinkCategoryList(Request $request){
        $types = DB::select("SELECT * FROM PCCDocumentCategories WHERE PCCFacilityId = " . $request->id);
        $id = $request->id;
        return view("PCC.LinkCategory", compact(["types", "id"]));
    }
    
    public function SaveLinkNoteType(Request $request){
        $facs = DB::table("PCCProgressNoteTypes")->where([["ProgressNoteTypeId", "=", $request->NoteId],["FacilityId", "=", $request->FacId]])->update([
            'EligibleToSend'=>true
        ]);
        return response()->json([
            "success"
        ]);
    }
    
    public function SaveLinkCategory(Request $request){
        $facs = DB::table("PCCDocumentCategories")->where([["Id", "=", $request->Id],["FacId", "=", $request->FacId]])->update([
            'EligibleToSend'=>true
        ]);
        return response()->json([
            "success"
        ]);
    }
    
    public function SaveLinkFacility(Request $request){
        $facs = DB::table("tblFacility")->where("Id", "=", $request->FacId)->update([
            'IsPCC'=>true,
            'PCCFacilityId'=>$request->PCCId
        ]);
        return response()->json([
            "success"
        ]);
    }
    
    public function ErrorLog(){
        $errorlog = DB::select("SELECT * FROM PCCErrorLog");
        $page = request('page', 1);
        $pageSize = 20;
        
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($errorlog, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($errorlog), $pageSize, $page,['path' => url('/pcc/errorlog')]);
        
        return view("PCC.ErrorLog", compact(['paginator', 'page']));
    }
        
    
    public function Webhooks(){
        $errorlog = DB::select("SELECT * FROM PCCWebhook");
        $page = request('page', 1);
        $pageSize = 20;
        
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($errorlog, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($errorlog), $pageSize, $page,['path' => url('/pcc/webhook')]);
        
        return view("PCC.Webhook", compact(['paginator', 'page']));
    }
    
    public function EnableOrg(Request $request){
        DB::table("PCCOrganization")->where("Id", "=", $request->id)->update([
           'Enable'=>true 
        ]);
    }
    
    public function MovePatient($id){
        $dup = DB::select("SELECT * FROM PCCDuplicatePatients WHERE PatientId = " . $id);
        DB::table("PCCDuplicatePatients")->where("PatientId", "=", $id)->update([
            'Processed'=>true
        ]);
        $fac = DB::select("SELECT * FROM tblFacility WHERE Name = '" . $dup[0]->NewFacilityName . "'");
        DB::table("WTAPatient")->where("PCCId", "=", $id)->update([
            'FacilityName'=>$dup[0]->NewFacilityName,
            'FacilityId'=>$fac[0]->Id
        ]);
    }
}
