<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use InvModels\SharedModels\Facility;
use InvModels\SharedModels\State;

class FacilityController extends Controller
{

    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $page = request('page', 1);
        $pageSize = 20;
        $facilities = \Illuminate\Support\Facades\DB::select("call GetFacilityList(0, 0)");
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($facilities, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($facilities), $pageSize, $page, ['path' => url('/facility/list')]);
        //dd($paginator);
        return view('facility.index', compact('paginator'));
    }

    public function edit($id)
    {
        $facility = Facility::where('Id', $id)->with('contacts')->get();
        $state = State::all();
        return view("facility.edit", ["facility" => $facility, 'State' => $state]);
    }

    public function Contacts($code)
    {
        $page = request('page', 1);
        $pageSize = 20;
        $list = DB::select("SELECT * FROM tbl_FacilityContacts WHERE FacilityID = " . $code);
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($list, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($list), $pageSize, $page, ['path' => url('/facility/contacts/' . $code)]);

        return view("facility.Contacts", compact(['paginator', 'code']));
    }

    public function EditContact($id, \Illuminate\Http\Request $request)
    {
        $facility = DB::select("call GetFacilityList(" . $request->FacilityID . ")");
        $contact = DB::select("select * From tbl_FacilityContacts WHERE ContactID = " . $id);
        return view("facility.EditContact", compact(['contact', 'facility', 'id']));
    }

    public function SaveContact(\Illuminate\Http\Request $request)
    {
        //dd($request);
        $userid = \Illuminate\Support\Facades\Auth::user()->id;
        $mytime = \Carbon\Carbon::now();
        if ($request->ContactID == 0) {
            DB::table("tbl_FacilityContacts")->insert([
                'FirstName' => $request->Firstname,
                'LastName' => $request->Lastname,
                'FacilityID' => $request->FacilityID,
                'JobTitle' => $request->jobtitle,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'Fax' => $request->Fax,
                'AddedBy' => $userid,
                'AddedOn' => $mytime->toDateTimeString(),
                'Active' => empty($request->chkActive) ? 0 : 1,
                'IsWoundTrackerApp' => empty($request->chkWoundTrackerApp) ? 0 : 1
            ]);
        } else {
            DB::table("tbl_FacilityContacts")->where('ContactID', $request->ContactID)->update([
                'FirstName' => $request->Firstname,
                'LastName' => $request->Lastname,
                'JobTitle' => $request->jobtitle,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'Fax' => $request->Fax,
                'UpdatedBy' => $userid,
                'UpdatedOn' => $mytime->toDateTimeString(),
                'Active' => empty($request->chkActive) ? 0 : 1,
                'IsWoundTrackerApp' => empty($request->chkWoundTrackerApp) ? 0 : 1
            ]);
        }
        return redirect('/facility/contacts/' . $request->FacilityID)->with('flash_message', 'Contact Saved');
    }
}
