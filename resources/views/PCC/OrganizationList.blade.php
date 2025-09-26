@extends('layouts.app', ['activePage' => 'visits', 'titlePage' => __('PointClickCare')])


@section('content')
<div class="modal fade" id="orgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add/Edit Organization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>

            </div>
            <div class="modal-body pt-0" style="max-height: 750px; overflow-y: auto;">
                <form onsubmit="return false;">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Organization ID</label>
                            <input type="text" class="form-control" id="OrgId" name="OrgId" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>OrgUUID</label>
                            <input type="text" class="form-control" id="OrgUUID" name="OrgUUID" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Organization Code</label>
                            <input type="text" class="form-control" id="OrgCode" name="OrgCode" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Organization Name</label>
                            <input type="text" class="form-control" id="OrgName" name="OrgName" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-sm btn-success" id="btnSaveOrg">Save</button>
                        <a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</a>
                    </div>
                </div>
                    </form>
            </div>
        </div>
    </div>
</div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12 p-0 pb-2 pt-1">
                        <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#orgModal">Add New</a>
                    </div>

                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="float-left">
                              <h4 class="text-white ">{{ __('PointClickCare Organizations') }}</h4>
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
                                            OrganizationId
                                        </th>
                                        <th>
                                            OrgUUID
                                        </th>
                                        <th>
                                            Code
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Enabled?
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orgs as $org)
                                    <tr>
                                        <td>
                                            {{$org->Id}}
                                        </td>
                                        <td>
                                            {{$org->OrgID}}
                                        </td>
                                        <td>
                                            {{$org->OrgUUID}}
                                        </td>
                                        <td>
                                            {{$org->OrgCode}}
                                        </td>
                                        <td>
                                            {{$org->Name}}
                                        </td>
                                        <th>
                                            {{$org->Enable ? "Enabled" : "Disabled"}}
                                            @if(!$org->Enable)
                                            <a href='javascript:;' class='btn btn-sm btn-info orgenable' data-id="{{$org->Id}}">Enable</a>
                                            @endif
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
    $(document).on("click", ".orgenable", function(){
        var id = $(this).attr("data-id");
        $.ajax({
            url: '/pcc/enableorg',
            type: "POST",
            data: { 'id': id}
        }).then(function(data){
            window.location.reload();
        });   
    });
    
    $(document).on("click", "#btnSaveOrg", function(){
        $.ajax({
            url: '/pcc/saveorg',
            type: "POST",
            data: { 'OrgId': $("#OrgId").val(), 'OrgUUID': $("#OrgUUID").val(), 'OrgCode': $("#OrgCode").val(), 'OrgName': $("#OrgName").val()}
        }).then(function(data){
            window.location.reload();
        });   
    });
</script>
@endsection