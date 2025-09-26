@extends('layouts.app', ['activePage' => 'visits', 'titlePage' => __('Visit List')])


@section('content')

    <div class="content">
        <div class="container-fluid">    
            <form method="GET" action="/visit/index">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <input type='text' class="form-control datetimepicker" name="fromdate" placeholder="From Date" value="{{\Carbon\Carbon::now()->startOfWeek()->format('m/d/Y')}}">
                                    </div>
                                  </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                     
                                        <input type='text' class="form-control datetimepicker" name="todate" placeholder="To Date" value="{{\Carbon\Carbon::now()->format('m/d/Y')}}">
                                    </div>
                                  </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <select class="form-control" name="facility">
                                        <option value="">Select Facility</option>
                                        @foreach($facilities as $facility)
                                        <option value="{{$facility->Idnumber}}" {{ $facilityid == $facility->Idnumber ? 'selected' : '' }}>{{$facility->codeValue}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select class="form-control" name="clinician">
                                        <option value="">Select Clinician</option>
                                        @foreach($clinicians as $clinician)
                                        <option value="{{$clinician->PhysicianID}}" {{ $physicianid == $clinician->PhysicianID ? 'selected' : '' }}>{{$clinician->Clinician}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3 text-right">
                                    <button type="submit" class="btn btn-danger btn-sm">Filter</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            
          <div class="row">
              <div class="col-md-12">
                    <form method="post" action="/forms/mileage" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        {{csrf_field()}}
                        @method('post')
                    </form>
                  <div class="card">
              <div class="card-header card-header-primary">
                  <div class="float-left">
                    <h4 class="card-title ">{{ __('Visits') }}</h4>
                    <p class="card-category"> {{ __('View all the visits') }}</p>
                  </div>
              </div>
              <div class="card-body">
                
                <div class="table-responsive">
                  <table class="table">
                      <thead class=" text-primary">
                          <tr>
                              <th>
                                  Patient Name
                              </th>
                              <th>
                                  MR Number
                              </th>
                              <th>
                                  Physician Name
                              </th>
                              <th>
                                  DOS
                              </th>
                              <th>
                                  Facility
                              </th>
                              <th class="text-right">
                                {{ __('Actions') }}
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($visits as $visit)
                          <tr>
                              <td>
                                  {{$visit->PatientFName . ' ' . $visit->PatientMName . ' ' . $visit->PatientLName}}
                              </td>
                              <td>
                                  {{$visit->PatientNumber}}
                              </td>
                              <td>
                                  {{$visit->PhysicianFName . ' ' . $visit->PhysicianLName}}
                              </td>
                              <td>
                                  {{$visit->DOS}}
                              </td>
                              <td>
                                  {{$visit->codeValue}}
                              </td>
                              <td class="td-actions text-right">
                                  <a href="" class="btn btn-info">Documents</a>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
              </div>
          </div>
        </div>
    </div>
@endsection
