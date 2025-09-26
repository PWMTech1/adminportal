<?php
$pg=1;
?>
@extends('layouts.app', ['activePage' => 'visits', 'titlePage' => __('PointClickCare')])


@section('content')
<div class="modal fade" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Patient Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>

            </div>
            <div class="modal-body pt-0" style="max-height: 750px; overflow-y: auto;">
                
            </div>
        </div>
    </div>
</div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="row">
                            <div class="col-lg-6">
                              <h4 class="text-white ">{{'PointClickCare Patients (Facility: ' . $fac[0]->FacilityName . ")" }}</h4>

                            </div>
                                <div class="col-lg-6 text-right">
                                      <h4 class="text-white">
                                          {{'Total: ' . $paginator->total() . ' patients'}}
                                      </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>
                                                Id
                                            </th>
                                            <th>
                                                Patient Name
                                            </th>
                                            <th>
                                                DOB
                                            </th>
                                            <th>
                                                Gender
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th class="text-right">
                                              {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paginator as $p)
                                        <tr>
                                            <td>
                                                {{$p->PatientId}}
                                            </td>
                                            <td>
                                                {{$p->LastName . ' ' . $p->MiddleName . ' ' . $p->FirstName}}
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse($p->BirthDate)->format('m/d/Y') }}
                                            </td>
                                            <td>
                                                {{$p->Gender}}
                                            </td>
                                            <td>
                                                {{$p->PatientStatus}}
                                            </td>
                                            <td class="text-right">
                                                <a href="javascript:;" class="btn btn-sm btn-success viewpatient" data-id='{{$p->PatientId}}'>View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="paginating-container pagination-solid">
                                    <ul class="pagination">
                                        <li class="prev"><a href="javascript:void(0);">Prev</a></li>
                                        @foreach($paginator->links()->elements[0] as $i)
                                            
                                            <li class="{{$pg == $page ? "active" : ""}}"><a href="{{$i}}">{{$pg++}}</a></li>                                            
                                            
                                        @endforeach
                                        <li class="next"><a href="javascript:void(0);">Next</a></li>
                                        
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="autorefresh" data-refresh="{{$reload}}"></div>
<input type="hidden" id="facid" value="{{$facid}}">
<script type='text/javascript'>
    $(document).on("click", ".viewpatient", function(){
        var id = $(this).attr("data-id");
        $.ajax({
            url: '/pcc/patientdetails',
            type: "POST",
            data: { 'id': id}
        }).then(function(data){
                $("#patientModal").modal('show');
                $("#patientModal").find('.modal-body').html(data.html);
        });        
    });
    
    $(document).ready(function(){
        if($("#autorefresh").attr("data-refresh") == "1"){
            window.setTimeout(function () {
                window.location.href = '/pcc/patientlist/' + $("#facid").val() + '/true';
              }, 10000);
        }
    });
</script>
@endsection