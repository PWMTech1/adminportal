<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FormMileage;
use App\Forms;
use App\ClinicianAdjustments;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Mail;
use InvModels\SharedModels\User;


class FormMileageController extends Controller
{
    public function index(Request $request)
    {
        return view('forms.mileage.create');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move('allfiles', $name);
        //dd($request);
        $form = Forms::create(['formtypeid' => 1, 'statusid' => 1, 'submittedby' => \Illuminate\Support\Facades\Auth::user()->id, 'submittedon' => date('Y-m-d H:i:s'), 'servicestart' => date('Y-m-d H:i:s', strtotime($request->fromdate)), 'serviceend' => date('Y-m-d H:i:s', strtotime($request->todate))]);
        FormMileage::create([
            'formid' => $form->Id, 'totalmiles' => $request->totalmiles, 'filename' => $name, 'extension' => $file->getClientOriginalExtension(),
            'OtherExpenses' => empty($request->totalexpenses) ? 0.0 : (float)($request->totalexpenses)
        ]);

        $formtype = \App\FormTypes::where('Id', '=', 1)->first();
        //dd($formtype);
        $user = auth()->user();

        $invuser = new User();
        Mail::to($formtype->SendTo)->send(new SendMailable($invuser, '', 'mileage'));
        return redirect('formexplorer')->with('flash_message', 'Mileage submitted!');
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
        $forms = Forms::where('Id', '=', $id)->with('formmileage')->first(); //FormMileage::where('formid','=',$id)->get();
        //dd($forms->formmileage->first());
        return view("forms.mileage.edit", compact('forms'));
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
        $action = $request->input('action');
        $formmileage = Forms::where('Id', '=', $id)->first();
        //dd($formmileage);
        if ($action == "reject") {
            $formmileage->Reason = $request->reason;
            $formmileage->StatusId = 3;
        } else if ($action == "approve") {
            $formmileage->StatusId = 2;
            $ffs = \App\FFSAdjustments::where('Id', '=', 1)->first();
            $mileage = FormMileage::where('FormId', '=', $id)->first();

            ClinicianAdjustments::create([
                'UserId' => $formmileage->SubmittedBy,
                'AdjustmentId' => 1,
                'CreatedOn' => date('Y-m-d'),
                'ServiceStart' => $formmileage->ServiceStart,
                'ServiceEnd' => $formmileage->ServiceEnd,
                'FormId' => $id,
                'Units' => $mileage->TotalMiles,
                'Amount' => ($mileage->TotalMiles * $ffs->UnitAmount)
            ]);

            if ($mileage->OtherExpenses > 0) {
                ClinicianAdjustments::create([
                    'UserId' => $formmileage->SubmittedBy,
                    'AdjustmentId' => 2,
                    'CreatedOn' => date('Y-m-d'),
                    'ServiceStart' => $formmileage->ServiceStart,
                    'ServiceEnd' => $formmileage->ServiceEnd,
                    'FormId' => $id,
                    'Units' => 1,
                    'Amount' => $mileage->OtherExpenses
                ]);
            }
        }
        $formmileage->ModifiedBy = \Illuminate\Support\Facades\Auth::user()->id;
        $formmileage->ModifiedOn = date('Y-m-d H:i:s');
        $formmileage->save();
        return redirect('formexplorer')->with('flash_message', 'Successfully updated');
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
}
