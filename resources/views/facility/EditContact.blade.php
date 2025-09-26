@extends('layouts.app', ['activePage' => 'facility-management', 'titlePage' => __('Facility Contact Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">        
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="float-left">
                              <h4 class="card-title ">{{ __('Facility Contacts') }}</h4>
                              <p class="card-category"> {{ __('Manage Facility contacts here') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/SaveContact"  enctype="multipart/form-data">
                                    @csrf
                                {{csrf_field()}}
                                @method('post')
                            <div class="row">
                                <label class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <input class="form-control" name="Firstname" type="text" placeholder="First Name" required="true"
                                             value="{{empty($contact) ? "" : $contact[0]->FirstName}}">
                                    </div>
                                  </div>
                                <label class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <input class="form-control" name="Lastname" type="text" placeholder="Last Name" required="true"
                                             value="{{empty($contact) ? "" : $contact[0]->LastName}}">
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Facility Name</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input class="form-control" id="Facilityname" type="text" placeholder="Facility Name" disabled="disabled" value="{{$facility[0]->Name}}">
                                    </div>
                                  </div>
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <input class="form-control" name="Email" type="text" placeholder="Email" required="true"
                                             value="{{empty($contact) ? "" : $contact[0]->Email}}">
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input name="FacilityID" type="hidden" id="hdnFacilityID" value="{{$facility[0]->code}}">
                                        <input name="ContactID" type="hidden" id="hdnContactID" value="{{empty($contact) ? $id : $contact[0]->ContactID}}">
                                        <input class="form-control" id="State" type="text" placeholder="State" disabled="disabled" value="{{$facility[0]->State}}">
                                    </div>
                                  </div>
                                <label class="col-sm-2 col-form-label">Job Title</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="form-control" name="jobtitle">
                                            <option value="">Select</option>
                                            <option value="Administrator" {{empty($contact) ? "" : ($contact[0]->JobTitle == "Administrator" ? "selected" : "")}}>Administrator</option>
                                            <option value="Charge Nurse" {{empty($contact) ? "" : ($contact[0]->JobTitle == "Charge Nurse" ? "selected" : "")}}>Charge Nurse</option>
                                            <option value="DON" {{empty($contact) ? "" : ($contact[0]->JobTitle == "DON" ? "selected" : "")}}>DON</option>
                                            <option value="WCN" {{empty($contact) ? "" : ($contact[0]->JobTitle == "WCN" ? "selected" : "")}}>WCN</option>
                                        </select>
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input class="form-control" name="Phone" type="text" placeholder="Phone" required value="{{empty($contact) ? "" : $contact[0]->Phone}}">
                                    </div>
                                  </div>
                                <label class="col-sm-2 col-form-label">Fax</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <input class="form-control" name="Fax" type="text" placeholder="Fax" value="{{empty($contact) ? "" : $contact[0]->Fax}}">
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Send Woundtracker App</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input name="chkWoundTrackerApp" type="checkbox" {{empty($contact) ? "" : ($contact[0]->IsWoundTrackerApp ? "checked" : "")}}>
                                    </div>
                                  </div>
                                <label class="col-sm-2 col-form-label">Active</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <input name="chkActive" type="checkbox" {{empty($contact) ? "" : ($contact[0]->Active ? "checked" : "")}}>
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 float-right">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a href="/facility/contacts/{{$facility[0]->code}}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection