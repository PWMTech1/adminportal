<?php
use App\Http\Controllers\HomeController;
use App\Roles;
$permissions = HomeController::getAllPermissionsPerUser();

?>
<x-MainLayout>
    <x-slot name="titlePage">
        PointClickCare
    </x-slot>
    <x-slot name="activePage">
        visits
    </x-slot>
    @section('content')
    <div class="modal fade" id="LinkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Link Facility</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>

                </div>
                <div class="modal-body pt-0" style="max-height: 750px; overflow-y: auto;">

                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-success" id="btnFacilityLink">Save</a>
                    <a href="javascript:;" class="btn btn-sm btn-success" id="btnNoteTypeLink">Save</a>
                    <a href="javascript:;" class="btn btn-sm btn-success" id="btnCategoryLink">Save</a>
                    <a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <h3 class="text-lg font-bold mb-3">Facility List</h3>
    <a href="/pcc/errorlog" class="bg-green-500 text-white p-2">Error Log</a>
    @if($permissions->AllowAll)
    <a href="/pcc/webhook" class="bg-green-500 text-white p-2">Webhooks</a>
    <a href="/pcc/settings" class="bg-green-500 text-white p-2">Settings</a>
    @endif

    <a href="/pcc/organizations" class="bg-green-500 text-white p-2">Organizations</a>
    <a href='/pcc/patientmanagement' class="bg-green-500 text-white p-2">Patient Management</a>
    <h4 class="mb-4"></h4>
    <x-table>
        <x-slot name="header">
            <x-table.heading>Id</x-table.heading>
            <x-table.heading>Facility Name</x-table.heading>
            <x-table.heading>Type</x-table.heading>
            <x-table.heading>TimeZone</x-table.heading>
            <x-table.heading>ProcessStarted</x-table.heading>
            <x-table.heading>ProcessEnded</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($facs as $fac)
            <tr>
                <x-table.row>{{$fac->FacId}}</x-table.row>
                <x-table.row>
                    <a href="/pcc/patientlist/{{$fac->Id}}/false">
                        <strong>{{$fac->FacilityName}}</strong>
                    </a>
                    (<a href="javscript:;" class="facilitydetails" data-id="{{$fac->Id}}">View</a>)
                    <p>
                        {{$fac->AddressLine1 . ' ' . $fac->City . ', ' . $fac->State . ' ' . $fac->PostalCode}}
                    </p>
                </x-table.row>
                <x-table.row>{{$fac->TypeDesc}}</x-table.row>
                <x-table.row>{{$fac->TimeZone}}</x-table.row>
                <x-table.row>{{$fac->ProcessStarted ? "Yes" : "No"}}</x-table.row>
                <x-table.row>{{$fac->ProcessEnded ? "Yes" : "No"}}</x-table.row>
                <x-table.row>
                    @if($permissions->AllowAll)
                    <a href="/pcc/redownload/{{$fac->Id}}/true" class="bg-blue-500 p-2 text-white">
                        Patients</a>
                    @endif
                    <a href="javascript:;" data-id="{{$fac->Id}}" class="bg-blue-500 p-2 text-white facilitylink">
                        Facility</a>
                    <a href="javascript:;" data-id="{{$fac->Id}}" class="bg-blue-500 p-2 text-white linknotetype">
                        Progress Note</a>
                    <a href="javascript:;" data-id="{{$fac->Id}}" class="bg-blue-500 p-2 text-white linkcategory">
                        Categories</a>
                    @if($permissions->AllowAll)
                    <a href="javascript:;" data-id="{{$fac->Id}}" class="bg-blue-500 p-2 text-white notetypes">
                        NoteTypes</a>
                    @endif
                    @if($permissions->AllowAll)
                    <a href="javascript:;" data-id="{{$fac->Id}}"
                        class="bg-blue-500 p-2 text-white categories">Categories</a>
                    @endif
                </x-table.row>
            </tr>
            @endforeach
        </x-slot>
    </x-table>
    <script type="text/javascript">
    $(document).on("click", ".facilitylink", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: '/pcc/pcclinkfacility',
            type: "POST",
            data: {
                'id': id
            }
        }).then(function(data) {
            $("#LinkModal").modal("show");
            $("#LinkModal").find(".modal-body").html(data);
            $("#LinkModal").find(".modal-title").html("Facility Link");
            $("#LinkModal").find("#btnNoteTypeLink").hide();
            $("#LinkModal").find("#btnCategoryLink").hide();
        });
    });

    $(document).on("click", "#btnFacilityLink", function() {
        var id = $('input[name="facility"]:checked').attr("data-id");
        $.ajax({
            url: '/pcc/savelinkfacility',
            type: "POST",
            data: {
                'FacId': id,
                'PCCId': $("#hdnFacilityID").val()
            },
            success: function(data) {
                alert("Facility is linked");
                window.location.reload();
            }
        })
    });

    $(document).on("click", ".linknotetype", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: '/pcc/pcclinknotetype',
            type: "POST",
            data: {
                'id': id
            }
        }).then(function(data) {
            $("#LinkModal").modal("show");
            $("#LinkModal").find(".modal-body").html(data);
            $("#LinkModal").find(".modal-title").html("Link Note Types");
            $("#LinkModal").find("#btnFacilityLink").hide();
            $("#LinkModal").find("#btnCategoryLink").hide();
        });
    });

    $(document).on("click", ".linkcategory", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: '/pcc/pcclinkcategory',
            type: "POST",
            data: {
                'id': id
            }
        }).then(function(data) {
            $("#LinkModal").modal("show");
            $("#LinkModal").find(".modal-body").html(data);
            $("#LinkModal").find(".modal-title").html("Link Document Categories");
            $("#LinkModal").find("#btnFacilityLink").hide();
            $("#LinkModal").find("#btnNoteTypeLink").hide();
        });
    });

    $(document).on("click", "#btnNoteTypeLink", function() {
        var id = $('input[name="notetype"]:checked').attr("data-id");
        $.ajax({
            url: '/pcc/savelinknotetype',
            type: "POST",
            data: {
                'NoteId': id,
                'FacId': $("#hdnFacilityID").val()
            },
            success: function(data) {
                alert("NoteType linked");
                window.location.reload();
            }
        })
    });

    $(document).on("click", "#btnCategoryLink", function() {
        var id = $('input[name="category"]:checked').attr("data-id");
        $.ajax({
            url: '/pcc/savelinkcategory',
            type: "POST",
            data: {
                'Id': id,
                'FacId': $("#hdnFacilityID").val()
            },
            success: function(data) {
                alert("Category linked");
                window.location.reload();
            }
        })
    });

    $(document).on("click", ".notetypes", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: '/pcc/redownloadnotetypes/' + id,
            type: "GET",
            success: function(data) {
                alert("Note Types are deleted and will be redownloaded.");
                window.location.reload();
            }
        });
    });

    $(document).on("click", ".categories", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: '/pcc/redownloadcategories/' + id,
            type: "GET",
            success: function(data) {
                alert("Document Categories are deleted and will be redownloaded.");
                window.location.reload();
            }
        });
    });

    $(document).on("click", ".facilitydetails", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: '/pcc/facilitydetails/' + id,
            type: "GET"
        }).then(function(data) {
            $("#LinkModal").modal("show");
            $("#LinkModal").find(".modal-body").html(data);
            $("#LinkModal").find(".modal-title").html("Facility Details");
            $("#LinkModal").find("#btnFacilityLink").hide();
            $("#LinkModal").find("#btnNoteTypeLink").hide();
        });
    });

    //    $(document).on("click", ".linknotetype", function(){
    //        var id = $(this).attr("data-id");
    //        $.ajax({
    //            url: '/pcc/pcclinknotetypes',
    //            type: "POST",
    //            data: {'id': id}
    //        }).then(function(data){
    //            $("#LinkModal").modal("show");
    //            $("#LinkModal").find(".modal-body").html(data);
    //        });  
    //    });
    </script>
    @endsection
</x-MainLayout>