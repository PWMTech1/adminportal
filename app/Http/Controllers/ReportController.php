<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function index()
    {
        return view("report.index");
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function downloadcsv()
    {
        $fileName = 'newpatients.csv';
        $data = DB::Select("SELECT * FROM new_patients_by_week");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('visitid', 'Physician', 'MRNumber', 'Patient_Name', 'DOS', 'Week_Ending', 'FacilityName', 'Encounter_Count');

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $d) {
                $row['visitid']  = $d->visitid;
                $row['Physician']    = $d->Physician;
                $row['MRNumber']    = $d->MRNumber;
                $row['Patient_Name']  = $d->Patient_Name;
                $row['DOS']  = $d->DOS;
                $row['Week_Ending']  = $d->Week_Ending;
                $row['FacilityName']  = $d->FacilityName;
                $row['Encounter_Count']  = $d->Encounter_Count;

                fputcsv($file, array(
                    $row['visitid'], $row['Physician'], $row['MRNumber'], $row['Patient_Name'], $row['DOS'],
                    $row['Week_Ending'], $row['FacilityName'], $row['Encounter_Count']
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
