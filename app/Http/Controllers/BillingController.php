<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use InvModels\SharedModels\ExternalBillingMain;
use InvModels\SharedModels\ExternalBillingCodes;
use InvModels\SharedModels\Patient;
use InvModels\SharedModels\Visit;

class BillingController extends Controller
{
    public function addeditcodes(Request $request){
        $patient = Patient::where("MRNumber", $request->MRNumber)->get();
        $visit = Visit::where("VisitId", $request->VisitId)->get();
        
        return view("Billing.addeditcodes", compact(["patient", "visit"]));
    }

    public function addcptcodes(Request $request){
        $items = array_filter(explode(";", $request->data), fn($value) => !is_null($value) && $value !== '');
        
        $data = array();
        foreach($items as $item){
            array_push($data, array(
                'CPTCode' => explode(",", explode('|', $item)[0])[0],
                'Units' => explode(",", explode('|', $item)[0])[1],
                'DiagnosisCodes' => explode('|', $item)[1],
                'Modifiers' => explode('|', $item)[2]
            ));
        }

        return view("Billing.cptcodes", compact(["data"]));
    }
}