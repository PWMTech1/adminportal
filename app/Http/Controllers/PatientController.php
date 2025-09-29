<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use App\Facility;
use App\Models\Language;
use App\Models\DocumentLibrary;
use App\Models\Communication;
use InvModels\SharedModels\Entity;
use InvModels\SharedModels\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use InvModels\SharedModels\DocumentLibrary as SharedModelsDocumentLibrary;

class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function List(Request $request)
    {
        $entity = Entity::all();
        $facilities = DB::select("call GetFacilityList(0, 0)");
        
        // Get all patients first
        $patient = Patient::all();
        
        // Apply filters to the collection
        if (!empty($request->facility)) {
            // Filter by facility name (not ID)
            $patient = $patient->where('FacilityName', $request->facility);
        }
        
        if (!empty($request->patientname)) {
            $patient = $patient->filter(function($p) use ($request) {
                $fullName = trim($p->FirstName . ' ' . $p->MiddleName . ' ' . $p->LastName);
                return stripos($fullName, $request->patientname) !== false;
            });
        }
        
        if (!empty($request->entities) && $request->entities != '-1') {
            $patient = $patient->where('EntityId', $request->entities);
        }
        
        // Convert to array for pagination
        $patientArray = $patient->toArray();
        
        // Manual pagination
        $page = request('page', 1);
        $pageSize = 10;
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($patientArray, $offset, $pageSize, true);
        
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $data,
            count($patientArray),
            $pageSize,
            $page,
            [
                'path' => url('/patient/list'),
                'pageName' => 'page'
            ]
        );
        
        // Add query parameters to pagination links
        $paginator->appends($request->query());

        return view("Patient.List", compact([
            'facilities', 'entity', 'paginator'
        ]))->with([
            'patientname' => $request->patientname,
            'facilityname' => $request->facility,
            'entities' => $request->entities
        ]);
    }

    public function AddPatient()
    {
        $mrnumber = $this->GenerateUniqueMRNumber();
        $facility = Facility::orderBy('Name')->get();
        $language = Language::all();
        $religion = Religion::orderBy('Description')->get();
        $communication = Communication::orderBy('Description')->get();
        return view("Patient.Add", compact(['mrnumber', 'facility', 'language', 'religion', 'communication']));
    }

    private function GenerateUniqueMRNumber()
    {
        $number = "MR" . mt_rand(1000000000, 9999999999); // better than rand()

        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }

        return $number;
    }

    private function GenerateUniqueId(){
        $number = mt_rand(1000000000, 9999999999); // better than rand()

        // call the same function if the barcode exists already
        if ($this->DocumentLibraryId($number)) {
            return GenerateUniqueId();
        }

        return $number;

    }

    function DocumentLibraryId($number){
        return DocumentLibrary::where("Id", $number)->exists();
    }

    function barcodeNumberExists($number)
    {
        return Patient::where("MRNumber", $number)->exists();
    }

    public function SavePatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required',
            'gender' => 'required',
            'facilityname' => 'required',
            'dob' => 'required',
            'admissiondate' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->input());
        }

        $facility = Facility::where("Id", $request->facilityname)->get();
        Patient::insert([
            'FirstName' => $request->firstname,
            'LastName' => $request->lastname,
            'MiddleName' => $request->middlename,
            'SSN' => $request->ssn,
            'DOB' => \Carbon\Carbon::parse($request->dob)->format("m/d/Y"),
            'Gender' => $request->gender,
            'Religion' => $request->religion,
            'SexualOrientation' => $request->sexualorientation,
            'Language' => $request->language,
            'Communication' => $request->communication,
            'FacilityName' => $facility[0]->Name,
            'FacilityId' => $request->facilityname,
            'AdmissionDate' => \Carbon\Carbon::parse($request->admissiondate)->format("m/d/Y"),
            'Bed' => $request->bed,
            'Room' => $request->room,
            'MrNumber' => $request->mrnumber,
            'PrimaryInsurance' => $request->primaryinsurance,
            'SecondaryInsurance' => $request->secondaryinsurance,
            'TetriaryInsurance' => $request->tetriaryinsurance,
            'PolicyNumber' => $request->policynumber,
            'PolicyNumber2' => $request->policynumber2,
            'PolicyNumber3' => $request->policynumber3
        ]);

        DocumentLibrary::insert([
            'Id' => $this->GenerateUniqueId(),
            'MRNumber' => $request->mrnumber,
            'Type' => 'Facesheet',
            'FileName' => $request->file('facesheet')->getClientOriginalName(),
            'File' => base64_encode(file_get_contents($request->file('facesheet'))),
            'Extension' => $request->file('facesheet')->getClientOriginalExtension(),
            'DateAdded' => \Carbon\Carbon::now()
        ]);

        return back()->with('message', 'Patient Added successfully and facesheet uploaded');
    }
}