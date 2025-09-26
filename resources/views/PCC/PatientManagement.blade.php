@extends('layouts.app', ['activePage' => 'visits', 'titlePage' => __('Patient Management')])
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12 p-0 pb-2 pt-1">
                        
                    </div>
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="float-left">
                              <h4 class="text-white ">{{ __('Patient Management') }}</h4>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            
                          <div class="table-responsive">
                              
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            MRNumber
                                        </th>
                                        <th>
                                            Patient Name
                                        </th>
                                        <th>
                                            New Facility
                                        </th>
                                        <th>
                                            Old Facility
                                        </th>
                                        <th>
                                            Issue
                                        </th>
                                        <th class="text-right">
                                          {{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pats as $p)
                                    <tr>
                                        <td>
                                            {{$p->MRNumber}}
                                        </td>
                                        <td>
                                            <strong>{{$p->FirstName . ' ' . $p->MiddleName . ' ' . $p->LastName}}</strong>
                                        </td>
                                        <td>
                                            {{$p->NewFacilityName}}
                                        </td>
                                        <td>
                                            {{$p->OldFacilityName}}
                                        </td>
                                        <th>
                                            Possible Duplicate
                                        </th>
                                        <th>
                                            <a href='javscript:;' class="btn btn-sm btn-primary movepatient" data-id="{{$p->PatientId}}">Move patient</a>
                                        </th>
                                        
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
    </div>
<script type="text/javascript">
    $(document).on("click", ".movepatient", function(){
        $.ajax({
            url: '/pcc/movepatient/' + $(this).attr("data-id"),
            type: 'GET',
            success: function(data){
                alert("Successfully moved patient to new facility");
                window.location.reload();
            }
        });
    });
</script>
@endsection