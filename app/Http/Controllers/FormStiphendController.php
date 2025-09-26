<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMailable;
use InvModels\SharedModels\Forms;
use InvModels\SharedModels\User;
use InvModels\SharedModels\FormStiphend;
use InvModels\SharedModels\ClinicianAdjustments;
use Illuminate\Support\Facades\Mail;


class FormStiphendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $form = Forms::create([
            'formtypeid' => $request->stiphend,
            'statusid' => 2,
            'submittedby' => \Illuminate\Support\Facades\Auth::user()->id,
            'submittedon' => date('Y-m-d H:i:s'),
            'servicestart' => date('Y-m-d H:i:s', strtotime($request->fromdate)),
            'serviceend' => date('Y-m-d H:i:s', strtotime($request->todate))
        ]);

        $form->fresh();

        FormStiphend::create([
            'FormId' => $form->Id,
            'ClinicianId' => $request->clinician,
            'Amount' => $request->amount
        ]);

        ClinicianAdjustments::create([
            'UserId' => $request->clinician,
            'AdjustmentId' => 5,
            'CreatedOn' => date('Y-m-d'),
            'ServiceFrom' => $form->servicestart,
            'ServiceEnd' => $form->sgiterviceend,
            'FormId' => $form->Id,
            'Units' => 1,
            'Amount' => $request->amount
        ]);

        $formtype = \App\FormTypes::where('Id', $request->stiphend)->first();
        $user = auth()->user();
        Mail::to($formtype->SendTo)->send(new SendMailable($user, '', 'stiphend'));
        return redirect('formexplorer')->with('flash_message', 'Mileage submitted!');
    }

    public function create()
    {
        $user = User::where([
            ["active", true],
            ["roleid", 1]
        ])->orderBy("firstname")->orderBy('lastname')->get();
        return view("forms.stiphends.create", compact('user'));
    }
}
