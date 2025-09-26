<x-MainLayout>
    <x-slot name="titlePage">
        Reviewed Visit List
    </x-slot>
    <x-slot name="activePage">
        woundtracker
    </x-slot>
    @section('content')
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    <form method="GET" action="/Visit/Reviewed">
        <div class="d-flex">
            <div class="mx-auto">
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0 pl-8">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Clinician
                        </label>
                        <select
                            class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="clinician">
                            <option value="">Select Clinician</option>
                            @foreach ($users as $u)
                            @if (empty($clinician))
                            <option value="{{ $u->id }}">{{ $u->firstname . ' ' . $u->lastname }}
                            </option>
                            @else
                            @if ($clinician == $u->id)
                            <option value="{{ $u->id }}" selected="selected">
                                {{ $u->firstname . ' ' . $u->lastname }}</option>
                            @else
                            <option value="{{ $u->id }}">{{ $u->firstname . ' ' . $u->lastname }}
                            </option>
                            @endif
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            From Date
                        </label>
                        <input type="text" name='fromdate'
                            class="datepicker text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="from date" value="{{ $fromdate }}">
                    </div>
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            To Date
                        </label>
                        <input type="text" name='todate'
                            class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 datepicker"
                            placeholder="to date" value="{{ $todate }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700' text-xs text-white text-center py-2 px-3 rounded mt-2">Filter
                        Results</button>
                </div>
            </div>
        </div>
    </form>
    <span class="inline-block">
        <button class="bg-blue-500 hover:bg-blue-700' text-xs text-white text-center py-2 px-3 rounded mb-2 viewnotes"
            type="button">View Reviewed Notes</button>
    </span>
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="genmodal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline" id="divhtml">

            </div>
        </div>
    </div>
    <x-table class="">
        <x-slot name="header">
            <x-table.heading>
                <x-checkbox id="chkHeader"></x-checkbox>
            </x-table.heading>
            <x-table.heading>PatientID</x-table.heading>
            <x-table.heading>Name</x-table.heading>
            <x-table.heading>Facility</x-table.heading>
            <x-table.heading>Clinician</x-table.heading>
            <x-table.heading>DOS</x-table.heading>
            <x-table.heading>Note Type</x-table.heading>
            <x-table.heading>Reviewed On</x-table.heading>
            <x-table.heading>Reviewed By</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach ($paginator as $patient)
            <tr class="{{ empty($patient->FileVisitID) ? 'bg-red-200' : '' }}">
                <x-table.row>
                    <x-checkbox id="chkBody" class="Checkbox" value="{{ $patient->VisitID }}"></x-checkbox>
                </x-table.row>
                <x-table.row>
                    <span class="inline-block mr-0">
                        <a title="Request new facesheet" href="javascript:;" onclick="UpdatedFacesheet(this)"
                            data-mrnumber="{{ $patient->PatientNumber }}">
                            <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <polyline points="16 16 12 12 8 16"></polyline>
                                <line x1="12" y1="12" x2="12" y2="21"></line>
                                <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>
                                <polyline points="16 16 12 12 8 16"></polyline>
                            </svg>
                        </a>
                    </span>
                    <span class="inline-block mr-0">
                        <a title="Upload Facesheet" href="javascript:;" onclick="toggleModal(this)"
                            data-patientname="{{ $patient->FirstName . ' ' . $patient->MiddleName . ' ' . $patient->LastName }}"
                            data-mrnumber="{{ $patient->PatientNumber }}" data-facility="{{ $patient->FacilityName }}">
                            <svg style="color: red; font-weight: bold;" xmlns="http://www.w3.org/2000/svg" width="12"
                                height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload"
                                title="Upload Facesheet">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                        </a>
                    </span>
                    <span class="inline-block">
                        @if (!empty($patient->DLMRNumber))
                        <a href="{{ route('facesheets', $patient->PatientNumber) }}" target="_blank"
                            style="text-decoration: underline; color: blue;">
                            {{ $patient->PatientNumber }}
                        </a>
                        @else
                        {{ $patient->PatientNumber }}
                        @endif
                    </span>
                </x-table.row>
                <x-table.row>{{ $patient->FirstName . ' ' . $patient->MiddleName . ' ' . $patient->LastName }}
                </x-table.row>
                <x-table.row>{{ $patient->FacilityName }}</x-table.row>
                <x-table.row>{{ $patient->PhysicianFName . ' ' . $patient->PhysicianLName }}</x-table.row>
                <x-table.row>{{ $patient->DOS }}</x-table.row>
                <x-table.row>
                    @if ($patient->GeneratedFile == 0)
                    <a href="javascript:;"
                        class="{{ $patient->IsNonVisit ? 'bg-green-600 hover:bg-green-800' : 'bg-blue-500 hover:bg-blue-700' }} text-xs text-white text-center py-1 px-3 rounded"
                        onclick="LoadPDF('{{ url('/visit/progressnotes/' . $patient->VisitID) }}');">
                        {{ $patient->IsNonVisit ? 'Non Visit' : 'Visit' }}
                    </a>
                    @else
                    <a href="/visit/generatednote/{{ $patient->VisitID }}" target="_blank"
                        class="{{ $patient->IsNonVisit ? 'bg-green-600 hover:bg-green-800' : 'bg-blue-500 hover:bg-blue-700' }} text-xs text-white text-center py-1 px-3 rounded">
                        {{ $patient->IsNonVisit ? 'Non Visit' : 'Visit' }}
                    </a>
                    @endif
                </x-table.row>
                <x-table.row>
                    {{$patient->ReviewedOn}}
                </x-table.row>
                <x-table.row>
                    {{$patient->ReviewedBy}}
                </x-table.row>
            </tr>
            @endforeach
        </x-slot>
    </x-table>
    <div class="d-flex py-3">
        <div class="mx-auto">
            {{ $paginator->links() }}
        </div>
    </div>

    <script type="text/javascript">
    function toggleModal(obj) {
        document.getElementById('modal').classList.toggle('hidden')
        if (obj != undefined) {
            $("#spPatientName").html($(obj).attr("data-patientname"));
            $("#spFacilityName").html($(obj).attr("data-facility"));
            $("#hdnMRNumber").val($(obj).attr("data-mrnumber"));
        }
    }

    function toggleReviewModal(obj) {
        document.getElementById('reviewmodal').classList.toggle('hidden')
        if (obj != undefined) {
            $("#spPatientName1").html($(obj).attr("data-patientname"));
            $("#spFacilityName1").html($(obj).attr("data-facility"));
            $("#hdnMRNumber1").val($(obj).attr("data-mrnumber"));
            $("#hdnVisitId").val($(obj).attr("data-visitid"));
            $("#spClinicianName1").html($(obj).attr("data-clinician"));
            $("#spDOB").html($(obj).attr("data-DOB"));
            $("#spDOS").html($(obj).attr("data-DOS"));
            $("#hdnClinicianId").val($(obj).attr("data-clinicianid"));
        }
    }

    function toggleGenModel(obj) {
        $.ajax({
            url: '/addeditcodes',
            method: "POST",
            data: {
                'MRNumber': $(obj).attr("data-mrnumber"),
                'VisitId': $(obj).attr("data-visitid")
            },
            success: function(data) {
                $("#divhtml").html(data);
                document.getElementById("genmodal").classList.toggle("hidden");
            }
        });
    }

    $(function() {
        $(".datepicker").datepicker();
        $("#dateReviewed").datepicker();
    });

    function LoadPDF(_url) {
        $.ajax({
            url: _url,
            type: 'GET',
            success: function(data) {
                let pdfWindow = window.open("");
                pdfWindow.document.write(
                    "<iframe width='100%' height='100%' src='" +
                    data.notes + "'></iframe>"
                );
            }
        });
    }

    $(document).on("click", ".viewnotes", function() {
        var output = $('.Checkbox:checked').map(function() {
            return this.value;
        }).get().join(',');
        if (output.length == 0)
            alert("Please select atleast one visit");
        else {
            window.open(
                "/viewallnotes?id=" + output,
                "AllNotes",
                "left=100,top=100,width=620,height=420"
            );
        }
    });

    $(document).on("change", "#chkHeader", function() {
        $("input:checkbox").not(this).not(".excludenonvisits").not(".markcompleted").prop('checked', this
            .checked);
    });

    $('.datepicker').datepicker();
    </script>
    @endsection
</x-MainLayout>