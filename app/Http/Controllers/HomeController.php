<?php

namespace App\Http\Controllers;

use App\Roles;
use App\User;
use App\Facility;
use App\Classes\XCounts;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use App\Charts\VisitStatistics;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $objects = new XCounts();
        $facilities = Facility::all();
        $objects->TotalFacilities = $facilities->where("IsTestFacility", "0")->count();
        $objects->TotalActiveFacilities = $facilities->filter(function($facility) {
            return $facility->StatusId == 1 || is_null($facility->StatusId);
        })->count();
        
        $start = new Carbon('first day of last month');
        $end = new Carbon('first day of this month');

        $visit = Visit::join('tblFacility', "WTAVisit.FacilityName", "=", "tblFacility.Name")
            ->where([["tblFacility.IsTestFacility", "=", 0], ["WTAVisit.IsNonVisit",  0]])
            ->whereBetween('DateAdded', [$start, $end])->get();

        $user = \Illuminate\Support\Facades\Auth::user();
        $notes = \Illuminate\Support\Facades\DB::select("SELECT p.FirstName AS PatientFName,p.LastName AS PatientLName,p.MiddleName AS PatientMName,
                                STR_TO_DATE(v.DOS, '%m/%d/%Y') AS DOS,
                                u.firstname, u.lastname,
                                f.Name, v.VisitID, v.IsNonVisit
                                FROM WTAPatient p
                                JOIN WTAVisit v ON p.MRNumber = v.MRNumber
                                JOIN users u ON u.id = v.Addedby
                                JOIN tblFacility f ON f.Name = v.FacilityName
                                WHERE f.IsTestFacility = 0 " .
            ($user->roleid == 1 || $user->roleid == 10 ? " AND v.Addedby = " . $user->id : ($user->roleid == 7 ? " AND v.Addedby = 0" : "") ).
            " ORDER BY 4 DESC
                                LIMIT 10");
    
        //dd($objects);
        return view('dashboard', compact(['objects', 'notes', 'visit']));
    }

    public function getDownload($id)
    {
        $mileage = \App\FormMileage::where('FormId', '=', $id)->first();

        $file = public_path() . "/allfiles/" . $mileage->FileName;
        $headers = [
            'Content-Type' => 'application/octet-stream',
        ];

        return response()->download($file, $mileage->FileName, $headers);
    }

    public static function getAllPermissionsPerUser()
    {
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $roleid = User::findOrFail($id)->roleid;
        return Roles::findOrFail($roleid);
    }

    public function GetVisitsByMonth()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        $tvisits = DB::select("select DATE_FORMAT(STR_TO_DATE(w.DOS, '%m/%d/%Y'), '%b-%Y') as x,COUNT(w.VisitID) y,
                            MONTH(STR_TO_DATE(w.DOS, '%m/%d/%Y')) as M,YEAR(STR_TO_DATE(w.DOS, '%m/%d/%Y')) as Y From WTAVisit w
                            join tblFacility f on f.Name = w.FacilityName
                            WHERE f.IsTestFacility = 0 AND 
                            DATE_FORMAT(STR_TO_DATE(w.DOS, '%m/%d/%Y'), '%Y-%m-%d') 
                                BETWEEN DATE_SUB(DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(CURDATE())-1 DAY), INTERVAL 24 MONTH) AND DATE_ADD(NOW(), INTERVAL 1 DAY)
                            AND IsNonVisit = 0 " .
            ($user->roleid == 1 ? " AND w.Addedby  = " . $user->id : ($user->roleid == 7 ? "v.Addedby = 0" : "")) . "
                            group by DATE_FORMAT(STR_TO_DATE(w.DOS, '%m/%d/%Y'), '%b-%Y'), MONTH(STR_TO_DATE(w.DOS, '%m/%d/%Y')),
                            YEAR(STR_TO_DATE(w.DOS, '%m/%d/%Y')) ORDER BY 4,3;");


        return Response::json($tvisits);
    }
}