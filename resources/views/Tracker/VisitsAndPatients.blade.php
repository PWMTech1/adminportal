<x-MainLayout>
    <x-slot name="titlePage">
        Patient and Visit List
    </x-slot>
    <x-slot name="activePage">
        woundtracker
    </x-slot>
    @section('content')
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    <form method="GET" action="/visitsandpatients">
        <div class="d-flex">
            <div class="mx-auto">
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Facility
                        </label>
                        <select
                            class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="facility">
                            <option value="">Select Facility</option>
                            @foreach ($facilities as $facility)
                            @if (empty($facilityname))
                            <option value="{{ $facility->Name }}">{{ $facility->Name }}</option>
                            @else
                            @if ($facilityname == $facility->Name)
                            <option value="{{ $facility->Name }}" selected="selected">
                                {{ $facility->Name }}
                            </option>
                            @else
                            <option value="{{ $facility->Name }}">{{ $facility->Name }}</option>
                            @endif
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0 pl-8">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Clinician
                        </label>
                        <select
                            class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="clinician">
                            @if (\Illuminate\Support\Facades\Auth::user()->roleid == 2 ||
                            \Illuminate\Support\Facades\Auth::user()->roleid == 7)
                            <option value="">Select Clinician</option>
                            @endif
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
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Patient Name
                    </label>
                    <input type="text" name='patientname'
                        class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full"
                        placeholder="Patient Name" value="{{ $patientname }}">
                </div>
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3 mb-6 md:mb-0 mt-7 text-xs">
                        <input type="checkbox" name='excludenonvisits' class="excludenonvisits"
                            {{ !empty($excludenonvisits) ? 'checked="checked"' : '' }}
                            {{ $roleid == 10 ? "disabled='disabled'" : ""}}> Exclude Non-Visits
                    </div>
                </div>
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3 mb-6 md:mb-0 mt-7 text-xs">
                        <input type="checkbox" name='markcompleted' class="markcompleted"
                            {{ !empty($markcompleted) ? 'checked="checked"' : '' }}> Only MarkCompleted
                    </div>
                </div>
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3 mb-6 md:mb-0 mt-7 text-xs">
                        <input type="checkbox" name='shownew' id="shownew" class="shownew"
                            {{ !empty($shownew) ? 'checked="checked"' : '' }}>
                        Show In-Completed Only
                    </div>
                </div>
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Entity
                    </label>
                    <select
                        class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="entities" id="entities">
                        <option value="-1"></option>
                        @foreach ($entity as $e)
                        @if ($entities == $e->index && Str::length($entities) > 0)
                        <option value="{{ $e->index }}" selected="selected">
                            {{ $e->Entity . ' - ' . $e->State }}</option>
                        @else
                        <option value="{{ $e->index }}">
                            {{ $e->Entity . ' - ' . $e->State }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3 mb-6 md:mb-0 mt-7 text-xs">
                        <input type="checkbox" name='isivr' id="isivr" class=""
                            {{ !empty($isivr) ? 'checked="checked"' : '' }}>
                        IVR only
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
        <button class="bg-green-500 hover:bg-green-700' text-xs text-white text-center py-2 px-3 rounded mb-2 completed"
            type="button">Mark Completed</button>
        <button class="bg-blue-500 hover:bg-blue-700' text-xs text-white text-center py-2 px-3 rounded mb-2 viewnotes"
            type="button">View Notes</button>
        @if($roleid == 2)
        <a class="bg-blue-500 hover:bg-blue-700' text-xs text-white text-center py-2 px-3 rounded mb-2"
            href="/Visit/Reviewed">View Reviewed Notes</a>
        @endif
    </span>
    <!-- Modal -->
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline" id="divFileUpload">
                <form method="POST" onsubmit="return uploadpdf();" enctype="multipart/form-data">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <input type="hidden" id="hdnMRNumber" name="hdnMRNumber">
                        <label class="text-sm font-bold">Patient Name</label>
                        <div id="spPatientName" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm"></div>
                        <label class="text-sm font-bold">Facility Name</label>
                        <div id="spFacilityName" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm"></div>
                        <label class="text-sm font-bold">Upload Facesheet</label>
                        <input type="file" required name="facesheet" id="facesheet">
                    </div>
                    <div class="bg-gray-100 px-4 py-3 text-right">
                        <button type="button" class="px-6
                        py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg
                        focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg
                        transition duration-150 ease-in-out" onclick="toggleModal()">Cancel</button>
                        <button type="submit" class="px-6
                        py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded
                        shadow-md hover:bg-blue-700 hover:shadow-lg
                        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="reviewmodal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline" id="divFileUpload">
                <form method="POST" onsubmit="return submitreview();" enctype="multipart/form-data">
                    <div class="bg-white px-4 pt-5 pb-1 sm:p-6 sm:pb-1">
                        <input type="hidden" id="hdnMRNumber1" name="hdnMRNumber">
                        <input type="hidden" id="hdnClinicianId" name="hdnClinicianId">
                        <input type="hidden" id="hdnVisitId" name="hdnVisitId">
                        <table class="w-full">
                            <tr>
                                <td>
                                    <label class="text-sm font-bold">Clinician</label>
                                    <div id="spClinicianName1" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm"></div>
                                </td>
                                <td>
                                    <label class="text-sm font-bold">Facility Name</label>
                                    <div id="spFacilityName1" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm"></div>
                                </td>
                                <td>
                                    <label class="text-sm font-bold">Patient Name</label>
                                    <div id="spPatientName1" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm"></div>
                                </td>
                                <td>
                                    <label class="text-sm font-bold">Date of Birth</label>
                                    <div id="spDOB" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm"></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="text-sm font-bold">Date of Service</label>
                                    <div id="spDOS" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm"></div>
                                </td>
                                <td colspan="2">
                                    <label class="text-sm font-bold">Date Reviewed</label>
                                    <input type="text" id="dateReviewed" required
                                        class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="checkbox" required id="chksignature" name="chksignature">Electronically
                                    signed
                                </td>
                            </tr>
                        </table>
                        <div>
                            <table class="w-full border-separate border-spacing-2 border border-slate-400">
                                <tr>
                                    <th class="text-left">Section</th>
                                    <th>Yes</th>
                                    <th>No</th>
                                    <th>N/A</th>
                                </tr>
                                <tr>
                                    <td>
                                        Chief Compliant
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="ChiefComplaint" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="ChiefComplaint" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="ChiefComplaint" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        History and Present Illness
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="History" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="History" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="History" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Physical Exam
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Physical" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Physical" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Physical" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Consulting with Pt and/or Nurse
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Nurse" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Nurse" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Nurse" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Follow Up
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="FollowUp" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="FollowUp" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="FollowUp" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Wound location
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Location" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Location" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Location" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Wound Etiology
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Etiology" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Etiology" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Etiology" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Wound Progress
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Progress" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Progress" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Progress" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Measurements
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Measurements" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Measurements" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Measurements" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Treatment Plan
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Treatment" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Treatment" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Treatment" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Procedures
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Procedures" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Procedures" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Procedures" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Debridement Type
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Debridements" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Debridements" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Debridements" value="-1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Diagnosis
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Diagnosis" value="1" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Diagnosis" value="0" required>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="Diagnosis" value="-1" required>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <label class="text-sm font-bold">Reviewer Notes</label>
                            <div>
                                <textarea width="100%" rows="3" style="width: 100%; border: 1px solid;"
                                    id="ReviewerNotes"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-1 text-right">
                        <button type="button" class="px-6
                        py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg
                        focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg
                        transition duration-150 ease-in-out" onclick="toggleReviewModal()">Cancel</button>
                        <button type="submit" class="px-6
                        py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded
                        shadow-md hover:bg-blue-700 hover:shadow-lg
                        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            <x-table.heading>Follow Up</x-table.heading>
            <x-table.heading>DOS</x-table.heading>
            <x-table.heading>Note Type</x-table.heading>
            @if($roleid == 10)
            <x-table.heading>Reviewed</x-table.heading>
            @endif
            @if($roleid != 10)
            <x-table.heading>Completed?</x-table.heading>
            <x-table.heading>LongTerm?</x-table.heading>
            @endif
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
                    <!-- <span class="inline-block">
                        <a href="javascript:;" title="Enter billing codes" onclick="toggleGenModel(this);"
                            data-mrnumber="{{ $patient->PatientNumber }}" data-visitid="{{ $patient->VisitID }}">
                            <svg style="color: orange; font-weight: bold;" xmlns="http://www.w3.org/2000/svg" width="12"
                                height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </a>
                    </span>
                    <span class="inline-block">
                        <a href="javascript:;" title="Edit Visit Notes" onclick=""
                            data-mrnumber="{{ $patient->PatientNumber }}" data-visitid="{{ $patient->VisitID }}">
                            <svg style="color: red; font-weight: bold;" xmlns="http://www.w3.org/2000/svg" width="1em"
                                height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1l1-4l9.5-9.5z" />
                                </g>
                            </svg>
                        </a>
                    </span> -->
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
                <x-table.row>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                        {{ $patient->FollowUpDate == '7 days'
                            ? 'bg-green-100 text-green-800'
                            : ($patient->FollowUpDate == 'More than 28 days'
                                ? 'bg-red-100 text-red-800'
                                : ($patient->FollowUpDate == '8 - 14 days'
                                    ? 'bg-orange-100 text-orange-800'
                                    : 'bg-green-100 text-green-800')) }}">
                        {{ $patient->FollowUpDate }}
                    </span>
                </x-table.row>
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
                @if($roleid == 10)
                <x-table.row>
                    <a href="javascript:;" onclick="toggleReviewModal(this)"
                        class="bg-green-600 hover:bg-green-800 text-xs text-white text-center py-1 px-3 rounded"
                        data-patientname="{{ $patient->FirstName . ' ' . $patient->MiddleName . ' ' . $patient->LastName }}"
                        data-mrnumber="{{ $patient->PatientNumber }}" data-facility="{{ $patient->FacilityName }}"
                        data-clinician="{{ $patient->PhysicianFName . ' ' . $patient->PhysicianLName}}"
                        data-DOB="{{$patient->DOB}}" data-DOS="{{$patient->DOS}}"
                        data-clinicianid="{{$patient->ClinicianId}}" data-visitid="{{ $patient->VisitID }}">
                        Review
                    </a>
                </x-table.row>
                @endif
                @if($roleid != 10)
                <x-table.row class="text-center">
                    @if ($patient->Completed)
                    <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1" style="color: green;">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    @endif
                </x-table.row>
                @endif
                <x-table.row class="text-center">
                    @if ($patient->IsLongTermCare)
                    <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1" style="color: green;">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    @endif
                </x-table.row>
                {{-- <x-table.row>
                            @if (empty($patient->FileVisitID))
                                <a href="/visit/newprogressnote/{{ $patient->VisitID }}" target="_blank"
                class="bg-blue-500 hover:bg-blue-700 text-xs text-white text-center py-1 px-3 rounded">
                Generate
                </a>
                @endif
                </x-table.row> --}}
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
    function UpdatedFacesheet(obj) {
        $.ajax({
            url: '/Tracker/UpdatedFacesheet',
            method: "POST",
            data: {
                'MRNumber': $(obj).attr("data-mrnumber")
            },
            success: function(data) {
                alert("Requested a new facesheet update for this patient");
            }
        });
    }

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

    $(document).on("change", "#facesheet", function() {
        handleFileSelect($(this));
    });

    function handleFileSelect(evt) {
        var files = $(evt)[0].files; // FileList object

        for (var i = 0, f; f = files[i]; i++) {
            var reader = new FileReader();

            reader.onload = (function(theFile) {
                return function(e) {
                    var fileString = e.target.result;

                    $("#divFileUpload").removeData("file");
                    $("#divFileUpload").removeData("filename");
                    $("#divFileUpload").removeData("extension");

                    $("#divFileUpload").data("file", fileString);
                    $("#divFileUpload").data("filename", theFile.name);
                    $("#divFileUpload").data("extension", theFile.name.split('.').pop().toLowerCase());
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }

    function submitreview() {
        var $formdata = {
            'MRNumber': $("#hdnMRNumber1").val(),
            'VisitId': $("#hdnVisitId").val(),
            'ClinicianId': $("#hdnClinicianId").val(),
            'DateReviewed': $("#dateReviewed").val(),
            'Notes': $("#ReviewerNotes").val(),
            'Signature': $("#chksignature").is(":checked") ? "1" : "0",
            'CComplaint': $("input[name=ChiefComplaint]:checked").val(),
            'History': $("input[name=History]:checked").val(),
            'Physical': $("input[name=Physical]:checked").val(),
            'Nurse': $("input[name=Nurse]:checked").val(),
            'FollowUp': $("input[name=FollowUp]:checked").val(),
            'Location': $("input[name=Location]:checked").val(),
            'Etiology': $("input[name=Etiology]:checked").val(),
            'Progress': $("input[name=Progress]:checked").val(),
            'Measurements': $("input[name=Measurements]:checked").val(),
            'Treatment': $("input[name=Treatment]:checked").val(),
            'Procedures': $("input[name=Procedures]:checked").val(),
            'Debridements': $("input[name=Debridements]:checked").val(),
            'Diagnosis': $("input[name=Diagnosis]:checked").val()
        };

        $.ajax({
            url: '/savereviewedvisits',
            type: 'POST',
            data: $formdata,
            success: function(response) {
                alert("Saved successfully");
                window.location.reload();
            }
        });
        return false;
    }

    function uploadpdf() {
        var $formdata = {
            'data': $("#divFileUpload").data("file"),
            'filename': $("#divFileUpload").data("filename"),
            'type': $("#divFileUpload").data("extension"),
            'MRNumber': $("#hdnMRNumber").val()
        };

        $.ajax({
            url: '/uploadfacesheet',
            type: 'POST',
            data: $formdata,
            success: function(response) {
                alert("Uploaded successfully");
                window.location.reload();
            }
        });
        return false;
    }

    function getBase64(file) {
        return new Promise((resolve, reject) => {

            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });
    }

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

    $(document).on("click", ".completed", function() {
        var output = $('.Checkbox:checked').map(function() {
            return this.value;
        }).get().join(',');
        if (output.length == 0)
            alert("Please select atleast one visit");
        else {
            $.ajax({
                url: '/UpdateVisitComplete',
                type: 'POST',
                data: {
                    'visits': output
                },
                success: function(data) {
                    alert("Compelted visits");
                    window.location.reload();
                }
            });
        }
    });

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