<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\FormMileage;
use App\Forms;
use App\FormTypes;
use App\FormStatus;

class FormController extends Controller
{
    public function index(Request $request)
    {
        $formtype = $request->get('formtype');
        $formstatus = $request->get('formstatus');
                
        $forms = Forms::with('formstatus','formtypes', 'formusers','modifiedusers')->orderBy("SubmittedOn","DESC")->get();
        if (!empty($formtype)) {
            $forms = $forms->where('FormTypeId', '=' , $formtype);
        }
        if (!empty($formstatus)) {
            $forms = $forms->where('StatusId', '=' , $formstatus);
        }
        $permissions = HomeController::getAllPermissionsPerUser();
        if(!$permissions->AllowAll){
            $forms = $forms->where('SubmittedBy', '=', \Illuminate\Support\Facades\Auth::user()->id);
        }
        
        $page = request('page', 1);
        $pageSize = 20;
        
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($forms->toArray(), $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($forms->toArray()), $pageSize, $page,['path' => url('/formexplorer')]);
        
        $types = FormTypes::all();        
        $status = FormStatus::all();
        //dd($paginator[0]["ServiceStart"]);
        return view('forms.index', compact(['paginator','types','status']));
    }

    public function __construct() {
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
