<?php
$i = 1;
$originalarray = $woundinfo;
?>
<!DOCTYPE html>
<!-- Created by pdf2htmlEX (https://github.com/coolwanglu/pdf2htmlex) -->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="generator" content="pdf2htmlEX"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <style>
            span.tick {
                content: '✓';
              }
            body{
                font-size:10px;
                font-family: Tahoma, sans-serif;
            }

            .col-percentages{
                width:25%; border: 1px solid #000; height:30px; vertical-align: top; font-size: 10px;
            }

            .col-treatment{
                width:25%; border: 1px solid #000; height:50px; vertical-align: top; font-size: 10px;
            }

            .col-progress{
                width:25%; border: 1px solid #000;vertical-align: middle; font-size: 10px; height:20px;
            }

            .col-asthetic{
                width:25%; border: 1px solid #000; height:30px; vertical-align: top; font-size:10px;
            }

            .col-etiology{
                width:25%; border: 1px solid #000; height:35px; vertical-align: top; font-size: 10px;
            }

            input[type="checkbox"] {
                display: inline-block;
                width: 15px;
                vertical-align: top;
                font-size:13px;
                padding: -2px 5px;
            }

            .checkbox{
                display: inline-block !important;
                vertical-align: top !important;
                font-size:10px !important;
            }

            input[type="text"] {
                outline: 0;
                border-width: 0 0 2px;
                border-color: black;
            }
            .label-text {
                display: inline-block;
                word-break: break-all;
            }

        </style>
    </head>
<body style="margin: -30px;">
    <table style="width:100%;">
    <tr>
        <td style="width:25%;">
            <img src="{{public_path() . '/img/ProHealthOne.gif'}}" style="width: 200px;" />
        </td>
        <td style="width:40%; text-align: center;">
            <strong style="font-size:12px;">Wound Tracker Form (v7.5)</strong>
            <div style="font-size:0.85em;">
                F: 888-972-8596 | T: 303-747-4117 | <a href="mailto:admin@prohealthone.com">admin@prohealthone.com</a>
            </div>
        </td>
        <td style="width:35%;">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <table style="width:100%; font-size:10px;">
                            <tr>
                                <td style="width:25px;">
                                    <div style="width:8px;height:8px; border: 1px solid black;">
                                        @if($patinfo[0]->PlaceofService == "Skilled")
                                            X
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <strong>Skilled</strong>
                                </td>

                                <td style="width:25px;">
                                    <div style="width:8px;height:8px; border: 1px solid black;">
                                        @if($patinfo[0]->PlaceofService == "Longterm")
                                            X
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <strong>Longterm</strong>
                                </td>
                                <td style="width:25px;">
                                    <div style="width:8px;height:8px; border: 1px solid black;">
                                        @if($patinfo[0]->PlaceofService == "Hospice")
                                            X
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <strong>Hospice</strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table style="width:100%;">
                            <tr>
                                <td style="text-align: left;"><strong>DX: </strong></td>
                                <td style="width:90%; border-bottom: 1px solid #000;">

                                </td>
                            </tr>
                        </table>

                    </td>

                </tr>
            </table>
        </td>
    </tr>
</table>
    <table style="width:100%;" cellspacing="0">
        @include('PartialView.PatientInfo',['patinfo' => $patinfo])
        <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td><strong>HPI:</strong></td>
                    <td style="width:96%; border-bottom: 1px solid #000;">
                        {{$patinfo[0]->HPIDescription}}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
       
<table style="width:100%; padding-top:10px;">
    <tr>
        <td style="width:20%; border: 1px solid #000;">
            <strong>Vitals:</strong>
            <table cellpadding="7" style="width:100%;">
                <tr>
                    <td><strong>Height (in):</strong></td>
                    <td>
                        {{$patinfo[0]->VitalsHeight}}
                    </td>
                </tr>
                <tr>
                    <td><strong>Weight (lbs):</strong></td>
                    <td>
                        {{$patinfo[0]->VitalsWeight}}
                    </td>
                </tr>
                <tr>
                    <td><strong>Temperature:</strong></td>
                    <td>
                        {{$patinfo[0]->VitalsTemp}}
                    </td>
                </tr>
                <tr>
                    <td><strong>Pulse (bpm):</strong></td>
                    <td>
                        {{$patinfo[0]->VitalsPulse}}
                    </td>
                </tr>
                <tr>
                    <td><strong>Respiratory rate:</strong></td>
                    <td>
                        {{$patinfo[0]->VitalsResp}}
                    </td>
                </tr>
                <tr>
                    <td><strong>Blood pressure:</strong></td>
                    <td>
                        {{$patinfo[0]->VitalsBP}}
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:20%; border: 1px solid #000;">
            <strong>Healing Delayed by:</strong>
            <table style="padding-top: 10px;width: 100%; font-size: 10px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'Contractures') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Contractures</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'Dementia') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Dementia</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'Diabetes') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Diabetes</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'ImpariedMobility') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Impaired mobility</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'Incontinence') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Incontinence</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'Aging') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Aging</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'LocalInfection') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Local infection</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'Malnutrition') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Malnutrition</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'Medications') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Medications</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'Noncompliant') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Non-compliant</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'Vascular') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Vascular</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->HealingDelayedBy, 'CurrentSmoker') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Current smoker</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input type="checkbox" value="Contractures" id=""><div class="label-text"><span>
                                    </span></div>
                                _______________
                        </label>
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:20%; border: 1px solid #000;">
            <strong>Preventive Measures:</strong>
            <table style="padding-top: 10px;width: 100%; font-size: 10px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->PreventiveMeasures, 'APMorLAL') !== false, null ) }}
                            <div class="label-text fa-lg"><span>APM or LAL mattress</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->PreventiveMeasures, 'OffloadingHeels') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Offloading heels</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->PreventiveMeasures, 'WheelchairCushion') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Wheelchair cushion</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->PreventiveMeasures, 'NutritionalSupplements') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Nutritional supplements</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->PreventiveMeasures, 'Catheter') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Catheter</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->PreventiveMeasures, 'PMEducation') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Education</span></div>
                        </label>
                    </td>
                </tr>                            
            </table>
            <div style="height: 1px; background: black; width: 100%;"></div>
            <strong>Falls in last 12 months:</strong>
            <table style="font-size:10px; width:100%;" cellspacing="0">
                <tr>
                    <td colspan="2">Number: 
                        <span style="border-bottom: 1px solid #000;">{{$patinfo[0]->TotalFalls}}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>                       
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->FallsType, 'WithInjury') !== false, null ) }}
                            <div class="label-text fa-lg"><span>With injury</span></div>                                        
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">                                    
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->FallsType, 'PlanofCare') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Plan of Care in place</span></div>                                        
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Aids:</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->Aid, 'Wheelchair') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Wheelchair</span></div>                                        
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->Aid, 'Walker') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Walker</span></div>                                        
                        </label>

                    </td>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->Aid, 'Cane') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Cane</span></div>                                        
                        </label>

                    </td>
                </tr>fs
            </table>
        </td>
        <td style="width:20%; border: 1px solid #000;">
            <strong>Diabetes:  {{$patinfo[0]->IsDiabetic == "Yes" ? "Y" : "N"}}</strong>
            <table style="padding-top: 10px;width: 100%; font-size: 10px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding-bottom: 5px;">
                        <label>
                            <input type="checkbox" value="Contractures" id=""><div class="label-text fa-lg"><span>Insulin</span></div>                                        
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input type="checkbox" value="Contractures" id=""><div class="label-text fa-lg"><span>Oral Hypoglycemic</span></div>                                        
                        </label>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px 10px;">
                        Blood Sugar: {{$patinfo[0]->BloodGlucose}}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px 10px;">
                        Sensation to BLE:    {{$patinfo[0]->ExamSensation == "Yes" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <div class="label-text fa-lg"><span>Shoe size: 
                                    {{$patinfo[0]->ShoeSize}}</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px 10px;">
                        HbA1c: {{$patinfo[0]->Results}} %
                    </td>
                </tr>     
                <tr>
                    <td style="padding: 5px 10px;">
                        Date: {{date('m/d/Y', strtotime($patinfo[0]->HbA1cDateOrdered))}}
                    </td>
                </tr>     
                <tr>
                    <td style="padding: 5px;">
                        <strong>Fluvax Admin Date:</strong>
                    </td>
                </tr>     
                <tr>
                    <td style="padding: 5px;">
                        {{$patinfo[0]->ImmunizationType == "Eligible" ? date('m/d/Y', strtotime($patinfo[0]->DateofImmunization)) : "__/__/____"}}
                    </td>
                </tr>     
            </table>
        </td>
        <td style="width:20%; border: 1px solid #000;">
            <strong>Procedures:</strong>
            <table style="padding-top: 10px;width: 100%; font-size: 10px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding-bottom: 5px;">
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->Procedures, 'PTOT') !== false, null ) }}
                            <div class="label-text fa-lg"><span>PT/OT eval and treat for:</span></div>

                        </label>
                        <label>
                            <input type="text">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->Procedures, 'Nicotine') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Nictonie Counseling</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, strpos($patinfo[0]->Procedures, 'DiabeticEducation') !== false, null ) }}
                            <div class="label-text fa-lg"><span>Diabetes Education</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, $patinfo[0]->LabsReviewed == "1", null ) }}
                            <div class="label-text fa-lg"><span>Labs reviewed</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            {{ Form::checkbox(null, null, $patinfo[0]->RadiologyReviewed == "1", null ) }}
                            <div class="label-text fa-lg"><span>Radiology reviewed</span></div>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        Discussed patient with:
                        <table style="width: 100%" cellspacing="0">
                            <tr>
                                <td>
                                    <label>
                                        {{ Form::checkbox(null, null, strpos($patinfo[0]->ProviderDiscussion, 'Therapist') !== false, null ) }}
                                        <div class="label-text fa-lg"><span>Therapy</span></div>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        {{ Form::checkbox(null, null, strpos($patinfo[0]->ProviderDiscussion, 'PCP') !== false, null ) }}
                                        <div class="label-text fa-lg"><span>Provider</span></div>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        {{ Form::checkbox(null, null, strpos($patinfo[0]->ProviderDiscussion, 'Family') !== false, null ) }}
                                        <div class="label-text fa-lg"><span>Family</span></div>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        {{ Form::checkbox(null, null, strpos($patinfo[0]->ProviderDiscussion, 'Dietician') !== false, null ) }}
                                        <div class="label-text fa-lg"><span>Dietician</span></div>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%;">
                                    <label>
                                        {{ Form::checkbox(null, null, strpos($patinfo[0]->ProviderDiscussion, 'NursePractitioner') !== false, null ) }}
                                        <div class="label-text fa-lg"><span>Nurse</span></div>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="Contractures" id="">
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>     
                <tr>
                    <td style="padding: 5px;">
                        {{$patinfo[0]->MinsSpent}} Mins. with pt., chart review, coordinating care.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table style="width:100%; padding: 2px;" cellspacing="0">
    <tr>
        <td style="width:25%; border: 1px solid #000; height:80px;">
            <strong>HEENT:</strong>
            <table style="width:100%;font-size:10px;">
                <tr>
                    <td style="text-align: left;">Hard of Hearing:</td>
                    <td style="text-align: right; width:35%;">
                        {{$patinfo[0]->Nose != "" && $patinfo[0]->Nose == "Normal" ? "N" : "Y"}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Dentures:</td>
                    <td style="text-align: right;">
                        {{$patinfo[0]->Mouth != "" && $patinfo[0]->Mouth == "Normal" ? "N" : "Y"}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Nares Patient:</td>
                    <td style="text-align: right;">
                        {{$patinfo[0]->Ears != "" && $patinfo[0]->Ears == "Normal" ? "N" : "Y"}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Mucous membranes:</td>
                    <td style="text-align: right;">
                        {{$patinfo[0]->MucousMembrane != "" && $patinfo[0]->MucousMembrane == "Normal" ? "WNL" : "ABN"}}
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:25%; border: 1px solid #000;">
            <strong>Cardiovascular:</strong>
            <table style="width:100%;font-size:10px;">
                <tr>
                    <td>Radial Pulse: &nbsp;&nbsp;
                        {{$patinfo[0]->RLERadialPulse != "" ? $patinfo[0]->RLERadialPulse . " RLE,    " : ""}}
                        {{$patinfo[0]->LLERadialPulse != "" ? $patinfo[0]->RLERadialPulse . " LLE" : ""}}
                    </td>
                </tr>
                <tr>
                    <td>Dorsalis pedis: 
                        {{$patinfo[0]->RLEDorsalisPedis != "" ? $patinfo[0]->RLEDorsalisPedis . " RLE,    " : ""}}
                        {{$patinfo[0]->LLEDorsalisPedis != "" ? $patinfo[0]->RLEDorsalisPedis . " LLE" : ""}}
                    </td>
                </tr>
                <tr>
                    <td>Edema:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{$patinfo[0]->RLEEdema != "" ||
                        $patinfo[0]->LLEEdema != "" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>
                    <td>Location: 
                        {{$patinfo[0]->RLEEdema != "" ? "RLE, " : ""}}
                        {{$patinfo[0]->LLEEdema != "" ? "LLE" : ""}}
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:25%; border: 1px solid #000;">
            <strong>Musculoskeletal:</strong>
            <table style="width:100%; font-size:10px;">
                <tr>
                    <td colspan="2">Decreased Strength:   
                        {{$patinfo[0]->RUEDecreaseStrength == "DecreasedStrengthRUEPresent" ? "RUE, " : ""}}
                        {{$patinfo[0]->LUEDecreaseStrength == "DecreasedStrengthLUEPresent" ? "LUE, " : ""}}
                        {{$patinfo[0]->RLEDecreaseStrength == "DecreasedStrengthRLEPresent" ? "RLE, " : ""}}
                        {{$patinfo[0]->LLEDecreaseStrength == "DecreasedStrengthLLEPresent" ? "LLE" : ""}}
                        </td>
                </tr>
                <tr>
                    <td colspan="2">Decreased ROM:
                        {{$patinfo[0]->RUEROM == "DecreasedROMRUEPresent" ? "RUE, " : ""}}
                        {{$patinfo[0]->LUEROM == "DecreasedROMLUEPresent" ? "LUE, " : ""}}
                        {{$patinfo[0]->RLEROM == "DecreasedROMRLEPresent" ? "RLE, " : ""}}
                        {{$patinfo[0]->LLEROM == "DecreasedROMLLEPresent" ? "LLE" : ""}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Contractures:</td>
                    <td style="text-align: right;">
                        {{$patinfo[0]->RUEContractures == "DecreasedContracturesRUEPresent" ||
                        $patinfo[0]->LUEContractures == "DecreasedContracturesLUEPresent" ||
                        $patinfo[0]->RLEContractures == "DecreasedContracturesRLEPresent" ||
                        $patinfo[0]->LLEContractures == "DecreasedContracturesLLEPresent" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Location:
                        {{$patinfo[0]->RUEContractures == "DecreasedContracturesRUEPresent" ? "RUE, " : ""}}
                        {{$patinfo[0]->LUEContractures == "DecreasedContracturesLUEPresent" ? "LUE, " : "" }}
                        {{$patinfo[0]->RLEContractures == "DecreasedContracturesRLEPresent" ? "RLE, " : "" }}
                        {{$patinfo[0]->LLEContractures == "DecreasedContracturesLLEPresent" ? "LLE" : ""}}
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:25%; border: 1px solid #000;">
            <strong>Neuro:</strong>
            <table style="width:100%;font-size:10px;">
                <tr>
                    <td>EOM Intact: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{$patinfo[0]->EOMIntact == "1" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>
                    <td>Sensation intact to:
                        <div>
                            {{$patinfo[0]->RUESensationIntact == "SensationIntactRUEYes" ? "RUE, " : ""}}
                            {{$patinfo[0]->LUESensationIntact == "SensationIntactLUEYes" ? "LUE, " : ""}}
                            {{$patinfo[0]->RLESensationIntact == "SensationIntactRLEYes" ? "RLE, " : ""}}
                            {{$patinfo[0]->LLESensationIntact == "SensationIntactLLEYes" ? "LLE" : ""}}</div>
                    </td>
                </tr>
                <tr>
                    <td>Facial dropping:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$patinfo[0]->FacialDrooping == "1" ? "Y" : "N"}}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="width:25%; border: 1px solid #000; height:80px;">
            <strong>Respiratory:</strong>
            <table style="width:100%;font-size:10px;">
                <tr>
                    <td colspan="2">Trachea Midline:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{$patinfo[0]->TracheaMidline == "1" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>

                    <td style="text-align: left;">Lungs Sounds:</td>
                    <td style="text-align: left;">
                        {{$patinfo[0]->LungsSound != "" && $patinfo[0]->LungsSound == "Clear" ? "Clear" : "Other: " . $patinfo[0]->LungsSound}}

                    </td>
                </tr>
            </table>
        </td>
        <td style="width:25%; border: 1px solid #000;">
            <strong>Abdomen:</strong>
            <table style="width:100%;font-size:10px;">
                <tr>
                    <td style="text-align: left;">S/NT/ND:</td>
                    <td style="text-align: right; width:35%;">
                        {{$patinfo[0]->Abdomen != "" && $patinfo[0]->Abdomen == "Normal" ? "N" : "Y"}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Obese:</td>
                    <td style="text-align: right;">
                        {{$patinfo[0]->Obese != "" && $patinfo[0]->Obese == "Large draping pannus" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Hemia:</td>
                    <td style="text-align: right;">
                        {{$patinfo[0]->Hernia == "1" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Bowel Sounds:</td>
                    <td style="text-align: right;">
                        {{$patinfo[0]->BowelSounds != "" && $patinfo[0]->BowelSounds == "1" ? "Y" : "N"}}
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:25%; border: 1px solid #000;">
            <strong>Lymphadenopathy:</strong>
            <table style="width:100%;font-size:10px;">
                <tr>
                    <td style="text-align: left;">Axilla:</td>
                    <td style="text-align: right; width:35%;">
                        {{$patinfo[0]->AxillaryNodes != "" && $patinfo[0]->AxillaryNodes == "Palpable" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Neck:</td>
                    <td style="text-align: right;">
                        {{$patinfo[0]->Neck != "" && $patinfo[0]->Neck == "Palpable" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Groin:</td>
                    <td style="text-align: right;">
                        {{$patinfo[0]->Groin != "" && $patinfo[0]->Groin == "Palpable" ? "Y" : "N"}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Other:</td>
                    <td>
                        {{$patinfo[0]->OtherArea != "" ? $patinfo[0]->OtherArea : ""}}
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:25%; border: 1px solid #000;">
            <strong>Orientation:</strong>
            <table style="width:100%;font-size:10px;">
                <tr>
                    <td>A&O x {{$patinfo[0]->OrientationAO}}</td>
                </tr>
                <tr>
                    <td colspan="2">Judgement:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$patinfo[0]->Judgement}}</td>
                </tr>
                <tr>
                    <td colspan="2">Compliant:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$patinfo[0]->Compliant}}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@for($j = 0; $j < count($woundinfo);$j+=4)

@if($j==4 || $j == 12 || $j ==20)

<span style='page-break-after: always;'></span>
<table style='width: 100%;'>
@include("PartialView.PatientInfo", ['patinfo' => $patinfo])    
</table>

@endif
@include("PartialView.WoundInfo", ['woundinfo' => collect($woundinfo)->slice($j,4)->toArray(), 'index' => $j])
@endfor
<table style="width: 100%; padding: 2px;">
    <tr>
        <td style="width: 50%; text-align: left;">
            <strong>Notes:</strong>
        </td>
        <td style="width: 50%; text-align: right; vertical-align: top;">
            <table style="width:100%; font-size:10px;">
                <tr>
                    <td style="width:25px;">
                        <div style="width:8px;height:8px; border: 1px solid black;"></div>
                    </td>
                    <td>
                        No Change to ROS
                    </td>

                    <td style="width:25px;">
                        <div style="width:8px;height:8px; border: 1px solid black;"></div>
                    </td>
                    <td>
                        No Change to Physical Exam
                    </td>
                </tr>
            </table>


        </td>
    </tr>
    <tr>
        <td colspan="2" style="width:100%; border-bottom: 1px solid #000; padding-top: 5px;">
        </td>
    </tr>
    <tr>
        <td colspan="2" style="width:100%; border-bottom: 1px solid #000; padding-top: 20px;">
        </td>
    </tr>
    <tr>
        <td colspan="2" style="width:100%; border-bottom: 1px solid #000; padding-top: 20px;">
        </td>
    </tr>
</table>
<table style="width: 100%; padding: 2px;">
    <tr>
        <td style="width: 50%; text-align: left;">
            <table style="width:100%; font-size:10px;">
                <tr>
                    <td>
                        <strong>Complexity</strong>
                    </td>
                    <td style="width:25px;">
                        <div style="width:8px;height:8px; border: 1px solid black;"></div>
                    </td>
                    <td>
                        Straightforward
                    </td>

                    <td style="width:25px;">
                        <div style="width:8px;height:8px; border: 1px solid black;"></div>
                    </td>
                    <td>
                        Low
                    </td>
                    <td style="width:25px;">
                        <div style="width:8px;height:8px; border: 1px solid black;"></div>
                    </td>
                    <td>
                        Medium
                    </td>
                    <td style="width:25px;">
                        <div style="width:8px;height:8px; border: 1px solid black;"></div>
                    </td>
                    <td>
                        High
                    </td>
                </tr>
            </table>

        </td>
        <td style="width: 50%; text-align: right; vertical-align: top;">
            <strong>Electronically signed by: {{$user[0]->firstname . ' ' . $user[0]->lastname}}</strong>
        </td>
    </tr>
</table>
        </body>
</html>
