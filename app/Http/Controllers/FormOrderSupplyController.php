<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InvModels\SharedModels\FormOrderSupplyTypes;
use InvModels\SharedModels\FormOrderSupplies;
use InvModels\SharedModels\FormOrderHeader;
use InvModels\SharedModels\FormAddress;
use InvModels\SharedModels\User;
use InvModels\SharedModels\Forms;
use InvModels\SharedModels\FormTypes;

class FormOrderSupplyController extends Controller
{
    public function index(Request $request)
    {
        return view('forms.supplies.index');
    }

    public function SupplyTable($id)
    {
        $supply = FormOrderSupplyTypes::whereIn('Id', $id)->get();
        return view("forms.supplies.table", compact('supply'));
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
        $address1 = $request->address1;
        $address2 = $request->address2;
        $city = $request->city;
        $state = $request->state;
        $zip = $request->zipcode;
        $ids = $request->hdnIds;
        
        $items = array_filter(explode(",", $ids), fn($value) => !is_null($value) && $value !== '');
        $arrcnt = array_count_values($items);

        $form = Forms::create(['formtypeid' => 2, 'statusid' => 1, 'submittedby' => \Illuminate\Support\Facades\Auth::user()->id, 'submittedon' => date('Y-m-d H:i:s')]);
        foreach ($arrcnt as $key => $value) {
            $formsupplytype = FormOrderSupplyTypes::where("Id", "=", $key)->first();

            $ordersupplies = new FormOrderSupplies();
            $ordersupplies->OrderSupplyTypeId = $key;
            $ordersupplies->Quantity = (int)$value;
            $ordersupplies->FormId = $form->Id;
            $ordersupplies->Processed = false;
            $ordersupplies->Price = $formsupplytype->PhysicianPrice;
            $ordersupplies->SubTotal = $formsupplytype->PhysicianPrice * (int)$value;
            $ordersupplies->Save();
        }
        // $formheader = new FormOrderHeader();
        // $formheader->FormId = $form->Id;
        // $formheader->Save();

        $user = auth()->user();
        $formaddress = new FormAddress();
        $formaddress->FormId = $form->Id;
        $formaddress->FirstName = $user->firstname;
        $formaddress->LastName = $user->lastname;
        $formaddress->Address = $address1;
        $formaddress->Address2 = $address2;
        $formaddress->City = $city;
        $formaddress->State = $state;
        $formaddress->Zipcode = $zip;
        $formaddress->Save();

        $formtype = FormTypes::where('Id', '=', 2)->first();
        
        $id = $user->id;
        $user = User::find($id);
        \Illuminate\Support\Facades\Mail::to($formtype->SendTo)->send(new \App\Mail\SendMailable($user, '', 'ordersupplies'));
        return redirect('formexplorer')->with('flash_message', 'Order Supplies submitted!');
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
        $formsupply = FormOrderSupplies::where('FormId', '=', $id)->with('SupplyTypes')->get();
        $forms = \App\Forms::where('Id', '=', $id)->with('address', 'formusers')->get();
        //dd($forms->first()->formusers->firstname);
        return view("forms.supplies.edit", compact(['formsupply', 'forms']));
    }

    public function create_order(Request $request){
        $items = array_filter(explode(",", $request->data), fn($value) => !is_null($value) && $value !== '');

        $supplies = FormOrderSupplyTypes::findMany($items);
        $arrcnt = array_count_values($items);

        return view("forms.supplies.supplytable", compact(['supplies', 'arrcnt']));
    }

    public function update(Request $request, $id)
    {
        $action = $request->input('action');
        $formmileage = \App\Forms::where('Id', '=', $id)->first();
        if ($action == "reject") {
            $formmileage->Reason = $request->reason;
            $formmileage->StatusId = 3;
        } else if ($action == "approve") {
            $formmileage->StatusId = 2;
        }
        $formmileage->ModifiedBy = \Illuminate\Support\Facades\Auth::user()->id;
        $formmileage->ModifiedOn = date('Y-m-d H:i:s');
        $formmileage->save();
        return redirect('formexplorer')->with('flash_message', 'Successfully updated');
    }

    public function destroy($id)
    {
    }
}