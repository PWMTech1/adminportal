<x-MainLayout>
    <x-slot name="titlePage">
        Patient and Visit List
    </x-slot>
    <x-slot name="activePage">
        woundtracker
    </x-slot>
    @section('content')
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    
    <div class="visits-container">
        <div class="visits-header">
            <h1 class="visits-title">Patient and Visit List</h1>
            <div class="visits-actions">
                <button class="btn-mark-completed completed" type="button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Mark Completed
                </button>
                <button class="btn-view-notes viewnotes" type="button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    View Notes
                </button>
                @if($roleid == 2)
                <a class="btn-view-reviewed" href="/Visit/Reviewed">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    View Reviewed Notes
                </a>
                @endif
            </div>
        </div>

        <form method="GET" action="/visitsandpatients" id="filterForm" class="filter-section">
            <div class="filter-form">
                <div class="filter-group">
                    <label class="filter-label">Facility</label>
                    <select class="filter-select" name="facility">
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

                <div class="filter-group">
                    <label class="filter-label">Clinician</label>
                    <select class="filter-select" name="clinician">
                        @if (\Illuminate\Support\Facades\Auth::user()->roleid == 2 ||
                        \Illuminate\Support\Facades\Auth::user()->roleid == 7)
                        <option value="">Select Clinician</option>
                        @endif
                        @foreach ($users as $u)
                        @if (empty($clinician))
                        <option value="{{ $u->id }}">{{ $u->firstname . ' ' . $u->lastname }}</option>
                        @else
                        @if ($clinician == $u->id)
                        <option value="{{ $u->id }}" selected="selected">
                            {{ $u->firstname . ' ' . $u->lastname }}</option>
                        @else
                        <option value="{{ $u->id }}">{{ $u->firstname . ' ' . $u->lastname }}</option>
                        @endif
                        @endif
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">From Date</label>
                    <input type="text" name='fromdate' class="filter-input datepicker" placeholder="From Date" value="{{ $fromdate }}">
                </div>

                <div class="filter-group">
                    <label class="filter-label">To Date</label>
                    <input type="text" name='todate' class="filter-input datepicker" placeholder="To Date" value="{{ $todate }}">
                </div>

                <div class="filter-group">
                    <label class="filter-label">Patient Name</label>
                    <input type="text" name='patientname' class="filter-input" placeholder="Patient Name" value="{{ $patientname }}">
                </div>

                <div class="filter-group">
                    <label class="filter-label">Entity</label>
                    <select class="filter-select" name="entities" id="entities">
                        <option value="-1">Select Entity</option>
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

                <div class="filter-group checkbox-group">
                    <label class="filter-checkbox">
                        <input type="checkbox" name='excludenonvisits' class="excludenonvisits"
                            {{ !empty($excludenonvisits) ? 'checked="checked"' : '' }}
                            {{ $roleid == 10 ? "disabled='disabled'" : ""}}>
                        <span class="checkmark"></span>
                        Exclude Non-Visits
                    </label>
                </div>

                <div class="filter-group checkbox-group">
                    <label class="filter-checkbox">
                        <input type="checkbox" name='markcompleted' class="markcompleted"
                            {{ !empty($markcompleted) ? 'checked="checked"' : '' }}>
                        <span class="checkmark"></span>
                        Only Mark Completed
                    </label>
                </div>

                <div class="filter-group checkbox-group">
                    <label class="filter-checkbox">
                        <input type="checkbox" name='shownew' id="shownew" class="shownew"
                            {{ !empty($shownew) ? 'checked="checked"' : '' }}>
                        <span class="checkmark"></span>
                        Show In-Completed Only
                    </label>
                </div>

                <div class="filter-group checkbox-group">
                    <label class="filter-checkbox">
                        <input type="checkbox" name='isivr' id="isivr" class=""
                            {{ !empty($isivr) ? 'checked="checked"' : '' }}>
                        <span class="checkmark"></span>
                        IVR Only
                    </label>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46"></polygon>
                        </svg>
                        Filter Results
                    </button>
                    <button type="button" class="btn-clear" onclick="clearFilters()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Clear Filters
                    </button>
                </div>
            </div>
        </form>
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
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Patient Visits</h2>
            </div>
            
            <div class="table-wrapper">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="chkHeader" class="table-checkbox">
                            </th>
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>Note Type</th>
                            <th>Facility</th>
                            <th>Clinician</th>
                            <th>Follow Up</th>
                            <th>DOS</th>
                            @if($roleid == 10)
                            <th>Reviewed</th>
                            @endif
                            @if($roleid != 10)
                            <th>Completed?</th>
                            <th>LongTerm?</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paginator as $patient)
                        <tr class="{{ empty($patient->FileVisitID) ? 'bg-red-50' : '' }}">
                            <td>
                                <input type="checkbox" class="Checkbox table-checkbox" value="{{ $patient->VisitID }}">
                            </td>
                            <td>
                                <div class="patient-actions">
                                    <button title="Request new facesheet" onclick="UpdatedFacesheet(this)" 
                                        data-mrnumber="{{ $patient->PatientNumber }}" class="btn-action btn-request">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="16 16 12 12 8 16"></polyline>
                                            <line x1="12" y1="12" x2="12" y2="21"></line>
                                            <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>
                                        </svg>
                                    </button>
                                    <button title="Upload Facesheet" onclick="toggleModal(this)" 
                                        data-patientname="{{ $patient->FirstName . ' ' . $patient->MiddleName . ' ' . $patient->LastName }}"
                                        data-mrnumber="{{ $patient->PatientNumber }}" 
                                        data-facility="{{ $patient->FacilityName }}" class="btn-action btn-upload">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="15"></line>
                                        </svg>
                                    </button>
                                    <div class="patient-id">
                                        @if (!empty($patient->DLMRNumber))
                                        <a href="{{ route('facesheets', $patient->PatientNumber) }}" target="_blank" class="patient-link">
                                            {{ $patient->PatientNumber }}
                                        </a>
                                        @else
                                        {{ $patient->PatientNumber }}
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="patient-info">
                                    <div class="patient-name">{{ $patient->FirstName . ' ' . $patient->MiddleName . ' ' . $patient->LastName }}</div>
                                </div>
                            </td>
                            <td>
                                @if ($patient->GeneratedFile == 0)
                                <button class="note-type-btn {{ $patient->IsNonVisit ? 'note-nonvisit' : 'note-visit' }}"
                                    onclick="openPDFModal('{{ url('/visit/progressnotes/' . $patient->VisitID) }}', '{{ $patient->VisitID }}', '{{ $patient->IsNonVisit ? 'Non Visit' : 'Visit' }}');">
                                    {{ $patient->IsNonVisit ? 'Non Visit' : 'Visit' }}
                                </button>
                                @else
                                <button class="note-type-btn {{ $patient->IsNonVisit ? 'note-nonvisit' : 'note-visit' }}"
                                    onclick="openPDFModal('/visit/generatednote/{{ $patient->VisitID }}', '{{ $patient->VisitID }}', '{{ $patient->IsNonVisit ? 'Non Visit' : 'Visit' }}');">
                                    {{ $patient->IsNonVisit ? 'Non Visit' : 'Visit' }}
                                </button>
                                @endif
                            </td>
                            <td>{{ $patient->FacilityName }}</td>
                            <td>{{ $patient->PhysicianFName . ' ' . $patient->PhysicianLName }}</td>
                            <td>
                                <span class="followup-badge 
                                    {{ $patient->FollowUpDate == '7 days' ? 'followup-good' : 
                                        ($patient->FollowUpDate == 'More than 28 days' ? 'followup-bad' : 
                                        ($patient->FollowUpDate == '8 - 14 days' ? 'followup-warning' : 'followup-good')) }}">
                                    {{ $patient->FollowUpDate }}
                                </span>
                            </td>
                            <td>{{ $patient->DOS }}</td>
                            @if($roleid == 10)
                            <td>
                                <button onclick="toggleReviewModal(this)" class="btn-review"
                                    data-patientname="{{ $patient->FirstName . ' ' . $patient->MiddleName . ' ' . $patient->LastName }}"
                                    data-mrnumber="{{ $patient->PatientNumber }}" 
                                    data-facility="{{ $patient->FacilityName }}"
                                    data-clinician="{{ $patient->PhysicianFName . ' ' . $patient->PhysicianLName}}"
                                    data-DOB="{{$patient->DOB}}" data-DOS="{{$patient->DOS}}"
                                    data-clinicianid="{{$patient->ClinicianId}}" 
                                    data-visitid="{{ $patient->VisitID }}">
                                    Review
                                </button>
                            </td>
                            @endif
                            @if($roleid != 10)
                            <td class="text-center">
                                @if ($patient->Completed)
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="check-icon">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($patient->IsLongTermCare)
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="check-icon">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pagination-container">
            {{ $paginator->links() }}
        </div>
    </div>

    <!-- PDF Modal -->
    <div class="fixed z-50 overflow-y-auto top-0 w-full left-0 hidden" id="pdfModal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="pdf-modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="pdf-modal-header">
                        <h3 class="pdf-modal-title" id="pdf-modal-headline">Visit Notes</h3>
                        <button type="button" class="pdf-modal-close" onclick="closePDFModal()">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="pdf-modal-content">
                        <div id="pdfContainer" class="pdf-container">
                            <div class="pdf-loading">
                                <div class="loading-spinner"></div>
                                <p>Loading PDF...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-100 px-4 py-3 text-right">
                    <button type="button" class="btn-modify-notes" onclick="modifyVisitNotes()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1l1-4l9.5-9.5z"></path>
                        </svg>
                        Modify Visit Notes
                    </button>
                    <button type="button" class="btn-close-modal" onclick="closePDFModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Visit Notes Modal -->
    <div class="fixed z-50 overflow-y-auto top-0 w-full left-0 hidden" id="editVisitModal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="edit-modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="edit-modal-header">
                        <h3 class="edit-modal-title" id="edit-modal-headline">Edit Visit Notes</h3>
                        <button type="button" class="edit-modal-close" onclick="closeEditModal()">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="edit-modal-content">
                        <form id="editVisitForm">
                            <input type="hidden" id="editVisitId" name="visitId">
                            <input type="hidden" id="editPatientId" name="patientId">
                            <input type="hidden" id="editFacilityId" name="facilityId">
                            <input type="hidden" id="editIsPCC" name="isPCC">
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Patient Name</label>
                                    <input type="text" id="editPatientName" class="form-input" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Facility</label>
                                    <input type="text" id="editFacilityName" class="form-input" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date of Service</label>
                                    <input type="text" id="editDOS" class="form-input" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Clinician</label>
                                    <input type="text" id="editClinician" class="form-input" readonly>
                                </div>
                            </div>

                            <div class="form-section">
                                <h4 class="section-title">Basic Visit Information</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">MR Number</label>
                                        <input type="text" id="editMRNumber" name="mrNumber" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Date of Service</label>
                                        <input type="date" id="editDOS" name="dos" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Place of Service</label>
                                        <input type="text" id="editPlaceofService" name="placeofService" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Date of Admission</label>
                                        <input type="date" id="editDateofAdmission" name="dateofAdmission" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">HPI Description</label>
                                        <textarea id="editHPIDescription" name="hpiDescription" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Fall Risk</label>
                                        <select id="editFallRisk" name="fallRisk" class="form-select">
                                            <option value="">Select Fall Risk</option>
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Total Falls</label>
                                        <input type="number" id="editTotalFalls" name="totalFalls" class="form-input" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Immunization Type</label>
                                        <input type="text" id="editImmunizationType" name="immunizationType" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Is Diabetic</label>
                                        <select id="editIsDiabetic" name="isDiabetic" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Is IVR</label>
                                        <select id="editIsIVR" name="isIVR" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Exam Sensation</label>
                                        <input type="text" id="editExamSensation" name="examSensation" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Diabetic Notes</label>
                                        <textarea id="editDiabeticNotes" name="diabeticNotes" class="form-textarea" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h4 class="section-title">Pulse and Circulation</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">RLE Radial Pulse</label>
                                        <input type="text" id="editRLERadialPulse" name="rleRadialPulse" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LLE Radial Pulse</label>
                                        <input type="text" id="editLLERadialPulse" name="lleRadialPulse" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">RLE Dorsalis Pedis</label>
                                        <input type="text" id="editRLEDorsalisPedis" name="rleDorsalisPedis" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LLE Dorsalis Pedis</label>
                                        <input type="text" id="editLLEDorsalisPedis" name="lleDorsalisPedis" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">RLE Edema</label>
                                        <input type="text" id="editRLEEdema" name="rleEdema" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LLE Edema</label>
                                        <input type="text" id="editLLEEdema" name="lleEdema" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Abdomen</label>
                                        <input type="text" id="editAbdomen" name="abdomen" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Obese</label>
                                        <select id="editObese" name="obese" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Hernia</label>
                                        <select id="editHernia" name="hernia" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Bowel Sounds</label>
                                        <input type="text" id="editBowelSounds" name="bowelSounds" class="form-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h4 class="section-title">Strength and Range of Motion</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">RUE Decrease Strength</label>
                                        <select id="editRUEDecreaseStrength" name="rueDecreaseStrength" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LUE Decrease Strength</label>
                                        <select id="editLUEDecreaseStrength" name="lueDecreaseStrength" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">RLE Decrease Strength</label>
                                        <select id="editRLEDecreaseStrength" name="rleDecreaseStrength" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LLE Decrease Strength</label>
                                        <select id="editLLEDecreaseStrength" name="lleDecreaseStrength" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">RUE ROM</label>
                                        <input type="text" id="editRUEROM" name="rueROM" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LUE ROM</label>
                                        <input type="text" id="editLUEROM" name="lueROM" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">RLE ROM</label>
                                        <input type="text" id="editRLEROM" name="rleROM" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LLE ROM</label>
                                        <input type="text" id="editLLEROM" name="lleROM" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">RUE Contractures</label>
                                        <select id="editRUEContractures" name="rueContractures" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LUE Contractures</label>
                                        <select id="editLUEContractures" name="lueContractures" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">RLE Contractures</label>
                                        <select id="editRLEContractures" name="rleContractures" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LLE Contractures</label>
                                        <select id="editLLEContractures" name="lleContractures" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">RUE Sensation Intact</label>
                                        <select id="editRUESensationIntact" name="rueSensationIntact" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LUE Sensation Intact</label>
                                        <select id="editLUESensationIntact" name="lueSensationIntact" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">RLE Sensation Intact</label>
                                        <select id="editRLESensationIntact" name="rleSensationIntact" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LLE Sensation Intact</label>
                                        <select id="editLLESensationIntact" name="lleSensationIntact" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h4 class="section-title">Head and Neck Examination</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Normocephalic</label>
                                        <select id="editNormocephalic" name="normocephalic" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">EOM Intact</label>
                                        <select id="editEOMIntact" name="eomIntact" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Facial Drooping</label>
                                        <select id="editFacialDrooping" name="facialDrooping" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Trachea Midline</label>
                                        <select id="editTracheaMidline" name="tracheaMidline" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Lungs Sound</label>
                                        <input type="text" id="editLungsSound" name="lungsSound" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Axillary Nodes</label>
                                        <input type="text" id="editAxillaryNodes" name="axillaryNodes" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Neck</label>
                                        <input type="text" id="editNeck" name="neck" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Other Area</label>
                                        <input type="text" id="editOtherArea" name="otherArea" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Groin</label>
                                        <input type="text" id="editGroin" name="groin" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Follow Up Date</label>
                                        <input type="date" id="editFollowUpDate" name="followUpDate" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nose</label>
                                        <input type="text" id="editNose" name="nose" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Mouth</label>
                                        <input type="text" id="editMouth" name="mouth" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Ears</label>
                                        <input type="text" id="editEars" name="ears" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Mucous Membrane</label>
                                        <input type="text" id="editMucousMembrane" name="mucousMembrane" class="form-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h4 class="section-title">Visit Details and Vitals</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Minutes Spent</label>
                                        <input type="number" id="editMinsSpent" name="minsSpent" class="form-input" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Signed</label>
                                        <select id="editSigned" name="signed" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Vitals BP</label>
                                        <input type="text" id="editVitalsBP" name="vitalsBP" class="form-input" placeholder="120/80">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Vitals Temp</label>
                                        <input type="number" id="editVitalsTemp" name="vitalsTemp" class="form-input" step="0.1" placeholder="98.6">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Vitals Height</label>
                                        <input type="text" id="editVitalsHeight" name="vitalsHeight" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Vitals Weight</label>
                                        <input type="text" id="editVitalsWeight" name="vitalsWeight" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Vitals Resp</label>
                                        <input type="number" id="editVitalsResp" name="vitalsResp" class="form-input" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Vitals Pulse</label>
                                        <input type="number" id="editVitalsPulse" name="vitalsPulse" class="form-input" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Falls Type</label>
                                        <input type="text" id="editFallsType" name="fallsType" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Preventive Measures</label>
                                        <textarea id="editPreventiveMeasures" name="preventiveMeasures" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Procedures</label>
                                        <textarea id="editProcedures" name="procedures" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Preventive Notes</label>
                                        <textarea id="editPreventiveNotes" name="preventiveNotes" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Provider Discussion</label>
                                        <textarea id="editProviderDiscussion" name="providerDiscussion" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Healing Delayed By</label>
                                        <textarea id="editHealingDelayedBy" name="healingDelayedBy" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Aid</label>
                                        <input type="text" id="editAid" name="aid" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Treatment</label>
                                        <textarea id="editTreatment" name="treatment" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Orientation AO</label>
                                        <select id="editOrientationAO" name="orientationAO" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Judgement</label>
                                        <select id="editJudgement" name="judgement" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Poor">Poor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Compliant</label>
                                        <select id="editCompliant" name="compliant" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Plan Notes</label>
                                        <textarea id="editPlanNotes" name="planNotes" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Exam Notes</label>
                                        <textarea id="editExamNotes" name="examNotes" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Investigation Notes</label>
                                        <textarea id="editInvestigationNotes" name="investigationNotes" class="form-textarea" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h4 class="section-title">Special Conditions</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Amputation LLE</label>
                                        <select id="editAmputationLLE" name="amputationLLE" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Amputation RLE</label>
                                        <select id="editAmputationRLE" name="amputationRLE" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Is Non Visit</label>
                                        <select id="editIsNonVisit" name="isNonVisit" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Non Visit Notes</label>
                                        <textarea id="editNonVisitNotes" name="nonVisitNotes" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pneumonia</label>
                                        <select id="editPuenomia" name="puenomia" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pneumonia Date</label>
                                        <input type="date" id="editPuenomiaDate" name="puenomiaDate" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pneumonia Reason</label>
                                        <textarea id="editPuenomiaReason" name="puenomiaReason" class="form-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pulse LLE</label>
                                        <input type="text" id="editPulseLLE" name="pulseLLE" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pulse RLE</label>
                                        <input type="text" id="editPulseRLE" name="pulseRLE" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Is Podiatry</label>
                                        <select id="editIsPodiatry" name="isPodiatry" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Is Dermatology</label>
                                        <select id="editIsDermatology" name="isDermatology" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Hospice</label>
                                        <select id="editHospice" name="hospice" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Sync Date</label>
                                        <input type="date" id="editSyncDate" name="syncDate" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Product</label>
                                        <input type="text" id="editProduct" name="product" class="form-input">
                                    </div>
                                </div>
                            </div>

                            <div class="changes-tracker" id="changesTracker" style="display: none;">
                                <h4 class="section-title">Changes Made</h4>
                                <div id="changesList" class="changes-list"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-100 px-4 py-3 text-right">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Cancel
                    </button>
                    <button type="button" class="btn-save" onclick="saveVisitChanges()" id="saveVisitBtn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17,21 17,13 7,13 7,21"></polyline>
                            <polyline points="7,3 7,8 15,8"></polyline>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="fixed z-60 overflow-y-auto top-0 w-full left-0 hidden" id="confirmModal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="confirm-modal-header">
                        <div class="confirm-icon">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 12l2 2 4-4"></path>
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                        </div>
                        <h3 class="confirm-title">Confirm Changes</h3>
                        <p class="confirm-message">
                            This will re-generate the visit note with your changes. 
                            <span id="pccWarning" style="display: none; color: #dc2626; font-weight: 600;">
                                Since this facility is PCC, it will also resubmit the note.
                            </span>
                        </p>
                        <div id="confirmChangesList" class="confirm-changes-list"></div>
                    </div>
                </div>
                <div class="bg-gray-100 px-4 py-3 text-right">
                    <button type="button" class="btn-cancel" onclick="closeConfirmModal()">
                        Cancel
                    </button>
                    <button type="button" class="btn-confirm" onclick="confirmSaveChanges()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                        Confirm & Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
    .visits-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem;
    }

    .visits-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        background: white;
        padding: 1.5rem 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .visits-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .visits-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .btn-mark-completed, .btn-view-notes, .btn-view-reviewed {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-mark-completed {
        background: #10b981;
        color: white;
    }

    .btn-mark-completed:hover {
        background: #059669;
        color: white;
    }

    .btn-view-notes {
        background: #3b82f6;
        color: white;
    }

    .btn-view-notes:hover {
        background: #2563eb;
        color: white;
    }

    .btn-view-reviewed {
        background: #6366f1;
        color: white;
    }

    .btn-view-reviewed:hover {
        background: #4f46e5;
        color: white;
    }

    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group.checkbox-group {
        flex-direction: row;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .filter-select, .filter-input {
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background: white;
    }

    .filter-select:focus, .filter-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .filter-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        font-size: 0.875rem;
        color: #374151;
    }

    .filter-checkbox input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #3b82f6;
    }

    .filter-actions {
        display: flex;
        gap: 0.75rem;
        grid-column: 1 / -1;
        justify-content: flex-start;
        margin-top: 1rem;
    }

    .btn-filter, .btn-clear {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-filter {
        background: #3b82f6;
        color: white;
    }

    .btn-filter:hover {
        background: #2563eb;
    }

    .btn-clear {
        background: #6b7280;
        color: white;
    }

    .btn-clear:hover {
        background: #4b5563;
    }

    .table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .table-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .table-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .table-wrapper {
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
    }

    .modern-table {
        width: 100%;
        min-width: 1200px;
        border-collapse: collapse;
    }

    .modern-table th {
        background: #f9fafb;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .modern-table td {
        padding: 1rem;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.875rem;
        color: #374151;
        white-space: nowrap;
    }

    .modern-table tr:hover {
        background: #f9fafb;
    }

    .table-checkbox {
        width: 16px;
        height: 16px;
        accent-color: #3b82f6;
    }

    .patient-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-action {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-request {
        background: #f3f4f6;
        color: #6b7280;
    }

    .btn-request:hover {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-upload {
        background: #fef2f2;
        color: #dc2626;
    }

    .btn-upload:hover {
        background: #fee2e2;
        color: #b91c1c;
    }

    .patient-id {
        margin-left: 0.5rem;
    }

    .patient-link {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
    }

    .patient-link:hover {
        text-decoration: underline;
    }

    .patient-info {
        display: flex;
        flex-direction: column;
    }

    .patient-name {
        font-weight: 500;
        color: #1f2937;
    }

    .followup-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .followup-good {
        background: #dcfce7;
        color: #166534;
    }

    .followup-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .followup-bad {
        background: #fee2e2;
        color: #991b1b;
    }

    .note-type-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s ease;
    }

    .note-visit {
        background: #dbeafe;
        color: #1e40af;
    }

    .note-visit:hover {
        background: #bfdbfe;
        color: #1e40af;
    }

    .note-nonvisit {
        background: #dcfce7;
        color: #166534;
    }

    .note-nonvisit:hover {
        background: #bbf7d0;
        color: #166534;
    }

    .btn-review {
        padding: 0.5rem 1rem;
        background: #10b981;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-review:hover {
        background: #059669;
    }

    .check-icon {
        color: #10b981;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 0.5rem;
    }

    .pagination li {
        display: flex;
    }

    .pagination a, .pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        color: #374151;
        text-decoration: none;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .pagination a:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
    }

    .pagination .active span {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }

    .pagination .disabled span {
        background: #f9fafb;
        color: #9ca3af;
        cursor: not-allowed;
    }

    /* PDF Modal Styles */
    #pdfModal {
        z-index: 9999 !important;
        position: fixed !important;
    }

    #pdfModal .bg-gray-900 {
        z-index: 9998 !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
    }

    #pdfModal .inline-block {
        z-index: 9999 !important;
        position: relative;
    }

    #pdfModal .flex {
        z-index: 9999 !important;
        position: relative;
    }

    .pdf-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .pdf-modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .pdf-modal-close {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 6px;
        color: #6b7280;
        transition: all 0.2s ease;
    }

    .pdf-modal-close:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .pdf-modal-content {
        height: 70vh;
        min-height: 500px;
    }

    .pdf-container {
        width: 100%;
        height: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
    }

    .pdf-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .pdf-loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #6b7280;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3b82f6;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 1rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .btn-modify-notes, .btn-close-modal {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-left: 0.5rem;
    }

    .btn-modify-notes {
        background: #3b82f6;
        color: white;
    }

    .btn-modify-notes:hover {
        background: #2563eb;
    }

    .btn-close-modal {
        background: #6b7280;
        color: white;
    }

    .btn-close-modal:hover {
        background: #4b5563;
    }

    /* Edit Visit Modal Styles */
    #editVisitModal {
        z-index: 9999 !important;
        position: fixed !important;
    }

    #editVisitModal .bg-gray-900 {
        z-index: 9998 !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
    }

    .edit-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .edit-modal-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .edit-modal-close {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 6px;
        color: #6b7280;
        transition: all 0.2s ease;
    }

    .edit-modal-close:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .edit-modal-content {
        max-height: 70vh;
        overflow-y: auto;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .form-section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #f9fafb;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 1rem 0;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #3b82f6;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input, .form-textarea, .form-select {
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background: white;
    }

    .form-input:focus, .form-textarea:focus, .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-input[readonly] {
        background: #f9fafb;
        color: #6b7280;
        cursor: not-allowed;
    }

    .changes-tracker {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1rem;
    }

    .changes-list {
        max-height: 200px;
        overflow-y: auto;
    }

    .change-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem;
        background: white;
        border-radius: 4px;
        margin-bottom: 0.5rem;
        border-left: 3px solid #f59e0b;
    }

    .change-field {
        font-weight: 600;
        color: #374151;
    }

    .change-value {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .btn-cancel, .btn-save, .btn-confirm {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-left: 0.5rem;
    }

    .btn-cancel {
        background: #6b7280;
        color: white;
    }

    .btn-cancel:hover {
        background: #4b5563;
    }

    .btn-save {
        background: #3b82f6;
        color: white;
    }

    .btn-save:hover {
        background: #2563eb;
    }

    .btn-confirm {
        background: #10b981;
        color: white;
    }

    .btn-confirm:hover {
        background: #059669;
    }

    /* Confirmation Modal Styles */
    #confirmModal {
        z-index: 10000 !important;
        position: fixed !important;
    }

    #confirmModal .bg-gray-900 {
        z-index: 9999 !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
    }

    .confirm-modal-header {
        text-align: center;
        padding: 1rem 0;
    }

    .confirm-icon {
        display: flex;
        justify-content: center;
        margin-bottom: 1rem;
        color: #10b981;
    }

    .confirm-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 1rem 0;
    }

    .confirm-message {
        color: #6b7280;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .confirm-changes-list {
        background: #f9fafb;
        border-radius: 6px;
        padding: 1rem;
        max-height: 200px;
        overflow-y: auto;
    }

    .confirm-change-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .confirm-change-item:last-child {
        border-bottom: none;
    }

    .confirm-change-field {
        font-weight: 600;
        color: #374151;
    }

    .confirm-change-value {
        color: #6b7280;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .visits-container {
            padding: 1rem;
        }

        .visits-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .visits-actions {
            justify-content: center;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            justify-content: center;
        }

        .pdf-modal-content {
            height: 60vh;
            min-height: 400px;
        }
    }
    </style>

    <script type="text/javascript">
    let currentVisitId = null;
    let currentPDFUrl = null;

    function clearFilters() {
        document.getElementById('filterForm').reset();
        document.getElementById('filterForm').submit();
    }

    function openPDFModal(pdfUrl, visitId, noteType) {
        currentVisitId = visitId;
        currentPDFUrl = pdfUrl;
        
        // Update modal title
        document.getElementById('pdf-modal-headline').textContent = noteType + ' Notes';
        
        // Show loading state
        document.getElementById('pdfContainer').innerHTML = `
            <div class="pdf-loading">
                <div class="loading-spinner"></div>
                <p>Loading PDF...</p>
            </div>
        `;
        
        // Show modal
        document.getElementById('pdfModal').classList.remove('hidden');
        
        // Load PDF after a short delay to show loading state
        setTimeout(() => {
            loadPDFInModal(pdfUrl);
        }, 500);
    }

    function loadPDFInModal(pdfUrl) {
        const pdfContainer = document.getElementById('pdfContainer');
        
        // Create iframe for PDF
        const iframe = document.createElement('iframe');
        iframe.src = pdfUrl;
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.style.border = 'none';
        
        // Handle iframe load
        iframe.onload = function() {
            console.log('PDF loaded successfully');
        };
        
        iframe.onerror = function() {
            pdfContainer.innerHTML = `
                <div class="pdf-loading">
                    <div style="color: #dc2626; font-size: 2rem; margin-bottom: 1rem;">⚠️</div>
                    <p style="color: #dc2626;">Failed to load PDF. Please try again.</p>
                </div>
            `;
        };
        
        // Replace loading content with iframe
        pdfContainer.innerHTML = '';
        pdfContainer.appendChild(iframe);
    }

    function closePDFModal() {
        document.getElementById('pdfModal').classList.add('hidden');
        currentVisitId = null;
        currentPDFUrl = null;
    }

    let originalVisitData = {};
    let currentChanges = {};

    function modifyVisitNotes() {
        if (currentVisitId) {
            openEditModal();
        } else {
            alert('No visit selected for modification.');
        }
    }

    function openEditModal() {
        // Clear form first to ensure clean state
        clearEditForm();
        
        // Hide changes tracker initially
        document.getElementById('changesTracker').style.display = 'none';
        
        // Show modal
        document.getElementById('editVisitModal').classList.remove('hidden');
        
        // Load visit data
        loadVisitData(currentVisitId);
    }

    function loadVisitData(visitId) {
        // Show loading state
        const saveBtn = document.getElementById('saveVisitBtn');
        const originalText = saveBtn.innerHTML;
        saveBtn.innerHTML = '<div class="loading-spinner" style="width: 16px; height: 16px; margin-right: 0.5rem;"></div>Loading...';
        saveBtn.disabled = true;

        // Make AJAX call to get visit data
        fetch('/visit/get-visit-data', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                visitId: visitId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Store original data for comparison
                originalVisitData = { ...data.visit };
                currentChanges = {};

                // Populate form fields
                populateEditForm(data.visit);
            } else {
                alert('Error loading visit data: ' + data.message);
                closeEditModal();
            }
        })
        .catch(error => {
            console.error('Error loading visit data:', error);
            alert('Error loading visit data. Please try again.');
            closeEditModal();
        })
        .finally(() => {
            // Reset button
            saveBtn.innerHTML = originalText;
            saveBtn.disabled = false;
        });
    }

    function populateEditForm(data) {
        // Basic Information (Read-only)
        document.getElementById('editVisitId').value = data.visitId || '';
        document.getElementById('editPatientId').value = data.patientId || '';
        document.getElementById('editFacilityId').value = data.facilityId || '';
        document.getElementById('editIsPCC').value = data.isPCC ? '1' : '0';
        document.getElementById('editPatientName').value = data.patientName || '';
        document.getElementById('editFacilityName').value = data.facilityName || '';
        document.getElementById('editDOS').value = data.dos || '';
        document.getElementById('editClinician').value = data.clinician || '';

        // Basic Visit Information
        document.getElementById('editMRNumber').value = data.mrNumber || '';
        document.getElementById('editDOS').value = data.dos || '';
        document.getElementById('editPlaceofService').value = data.placeofService || '';
        document.getElementById('editDateofAdmission').value = data.dateofAdmission || '';
        document.getElementById('editHPIDescription').value = data.hpiDescription || '';
        document.getElementById('editFallRisk').value = data.fallRisk || '';
        document.getElementById('editTotalFalls').value = data.totalFalls || '';
        document.getElementById('editImmunizationType').value = data.immunizationType || '';
        document.getElementById('editIsDiabetic').value = data.isDiabetic || '';
        document.getElementById('editIsIVR').value = data.isIVR || '';
        document.getElementById('editExamSensation').value = data.examSensation || '';
        document.getElementById('editDiabeticNotes').value = data.diabeticNotes || '';

        // Pulse and Circulation
        document.getElementById('editRLERadialPulse').value = data.rleRadialPulse || '';
        document.getElementById('editLLERadialPulse').value = data.lleRadialPulse || '';
        document.getElementById('editRLEDorsalisPedis').value = data.rleDorsalisPedis || '';
        document.getElementById('editLLEDorsalisPedis').value = data.lleDorsalisPedis || '';
        document.getElementById('editRLEEdema').value = data.rleEdema || '';
        document.getElementById('editLLEEdema').value = data.lleEdema || '';
        document.getElementById('editAbdomen').value = data.abdomen || '';
        document.getElementById('editObese').value = data.obese || '';
        document.getElementById('editHernia').value = data.hernia || '';
        document.getElementById('editBowelSounds').value = data.bowelSounds || '';

        // Strength and ROM
        document.getElementById('editRUEDecreaseStrength').value = data.rueDecreaseStrength || '';
        document.getElementById('editLUEDecreaseStrength').value = data.lueDecreaseStrength || '';
        document.getElementById('editRLEDecreaseStrength').value = data.rleDecreaseStrength || '';
        document.getElementById('editLLEDecreaseStrength').value = data.lleDecreaseStrength || '';
        document.getElementById('editRUEROM').value = data.rueROM || '';
        document.getElementById('editLUEROM').value = data.lueROM || '';
        document.getElementById('editRLEROM').value = data.rleROM || '';
        document.getElementById('editLLEROM').value = data.lleROM || '';
        document.getElementById('editRUEContractures').value = data.rueContractures || '';
        document.getElementById('editLUEContractures').value = data.lueContractures || '';
        document.getElementById('editRLEContractures').value = data.rleContractures || '';
        document.getElementById('editLLEContractures').value = data.lleContractures || '';
        document.getElementById('editRUESensationIntact').value = data.rueSensationIntact || '';
        document.getElementById('editLUESensationIntact').value = data.lueSensationIntact || '';
        document.getElementById('editRLESensationIntact').value = data.rleSensationIntact || '';
        document.getElementById('editLLESensationIntact').value = data.lleSensationIntact || '';

        // Head and Neck Exam
        document.getElementById('editNormocephalic').value = data.normocephalic || '';
        document.getElementById('editEOMIntact').value = data.eomIntact || '';
        document.getElementById('editFacialDrooping').value = data.facialDrooping || '';
        document.getElementById('editTracheaMidline').value = data.tracheaMidline || '';
        document.getElementById('editLungsSound').value = data.lungsSound || '';
        document.getElementById('editAxillaryNodes').value = data.axillaryNodes || '';
        document.getElementById('editNeck').value = data.neck || '';
        document.getElementById('editOtherArea').value = data.otherArea || '';
        document.getElementById('editGroin').value = data.groin || '';
        document.getElementById('editFollowUpDate').value = data.followUpDate || '';
        document.getElementById('editNose').value = data.nose || '';
        document.getElementById('editMouth').value = data.mouth || '';
        document.getElementById('editEars').value = data.ears || '';
        document.getElementById('editMucousMembrane').value = data.mucousMembrane || '';

        // Visit Details and Vitals
        document.getElementById('editMinsSpent').value = data.minsSpent || '';
        document.getElementById('editSigned').value = data.signed || '';
        document.getElementById('editVitalsBP').value = data.vitalsBP || '';
        document.getElementById('editVitalsTemp').value = data.vitalsTemp || '';
        document.getElementById('editVitalsHeight').value = data.vitalsHeight || '';
        document.getElementById('editVitalsWeight').value = data.vitalsWeight || '';
        document.getElementById('editVitalsResp').value = data.vitalsResp || '';
        document.getElementById('editVitalsPulse').value = data.vitalsPulse || '';
        document.getElementById('editFallsType').value = data.fallsType || '';
        document.getElementById('editPreventiveMeasures').value = data.preventiveMeasures || '';
        document.getElementById('editProcedures').value = data.procedures || '';
        document.getElementById('editPreventiveNotes').value = data.preventiveNotes || '';
        document.getElementById('editProviderDiscussion').value = data.providerDiscussion || '';
        document.getElementById('editHealingDelayedBy').value = data.healingDelayedBy || '';
        document.getElementById('editAid').value = data.aid || '';
        document.getElementById('editTreatment').value = data.treatment || '';
        document.getElementById('editOrientationAO').value = data.orientationAO || '';
        document.getElementById('editJudgement').value = data.judgement || '';
        document.getElementById('editCompliant').value = data.compliant || '';
        document.getElementById('editPlanNotes').value = data.planNotes || '';
        document.getElementById('editExamNotes').value = data.examNotes || '';
        document.getElementById('editInvestigationNotes').value = data.investigationNotes || '';

        // Special Conditions
        document.getElementById('editAmputationLLE').value = data.amputationLLE || '';
        document.getElementById('editAmputationRLE').value = data.amputationRLE || '';
        document.getElementById('editIsNonVisit').value = data.isNonVisit || '';
        document.getElementById('editNonVisitNotes').value = data.nonVisitNotes || '';
        document.getElementById('editPuenomia').value = data.puenomia || '';
        document.getElementById('editPuenomiaDate').value = data.puenomiaDate || '';
        document.getElementById('editPuenomiaReason').value = data.puenomiaReason || '';
        document.getElementById('editPulseLLE').value = data.pulseLLE || '';
        document.getElementById('editPulseRLE').value = data.pulseRLE || '';
        document.getElementById('editIsPodiatry').value = data.isPodiatry || '';
        document.getElementById('editIsDermatology').value = data.isDermatology || '';
        document.getElementById('editHospice').value = data.hospice || '';
        document.getElementById('editSyncDate').value = data.syncDate || '';
        document.getElementById('editProduct').value = data.product || '';

        // Add change tracking listeners
        addChangeTrackingListeners();
    }

    function addChangeTrackingListeners() {
        const form = document.getElementById('editVisitForm');
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            if (!input.readOnly) {
                input.addEventListener('input', trackChanges);
                input.addEventListener('change', trackChanges);
            }
        });
    }

    function trackChanges(event) {
        const field = event.target;
        const fieldName = field.name;
        const newValue = field.value;
        const originalValue = originalVisitData[fieldName] || '';

        if (newValue !== originalValue) {
            currentChanges[fieldName] = {
                original: originalValue,
                new: newValue,
                field: fieldName
            };
        } else {
            delete currentChanges[fieldName];
        }

        updateChangesTracker();
    }

    function updateChangesTracker() {
        const changesTracker = document.getElementById('changesTracker');
        const changesList = document.getElementById('changesList');
        
        if (Object.keys(currentChanges).length > 0) {
            changesTracker.style.display = 'block';
            changesList.innerHTML = '';
            
            Object.values(currentChanges).forEach(change => {
                const changeItem = document.createElement('div');
                changeItem.className = 'change-item';
                changeItem.innerHTML = `
                    <span class="change-field">${getFieldDisplayName(change.field)}</span>
                    <span class="change-value">${change.new}</span>
                `;
                changesList.appendChild(changeItem);
            });
        } else {
            changesTracker.style.display = 'none';
        }
    }

    function getFieldDisplayName(fieldName) {
        const fieldNames = {
            // Basic Visit Information
            'mrNumber': 'MR Number',
            'dos': 'Date of Service',
            'placeofService': 'Place of Service',
            'dateofAdmission': 'Date of Admission',
            'hpiDescription': 'HPI Description',
            'fallRisk': 'Fall Risk',
            'totalFalls': 'Total Falls',
            'immunizationType': 'Immunization Type',
            'isDiabetic': 'Is Diabetic',
            'isIVR': 'Is IVR',
            'examSensation': 'Exam Sensation',
            'diabeticNotes': 'Diabetic Notes',
            
            // Pulse and Circulation
            'rleRadialPulse': 'RLE Radial Pulse',
            'lleRadialPulse': 'LLE Radial Pulse',
            'rleDorsalisPedis': 'RLE Dorsalis Pedis',
            'lleDorsalisPedis': 'LLE Dorsalis Pedis',
            'rleEdema': 'RLE Edema',
            'lleEdema': 'LLE Edema',
            'abdomen': 'Abdomen',
            'obese': 'Obese',
            'hernia': 'Hernia',
            'bowelSounds': 'Bowel Sounds',
            
            // Strength and ROM
            'rueDecreaseStrength': 'RUE Decrease Strength',
            'lueDecreaseStrength': 'LUE Decrease Strength',
            'rleDecreaseStrength': 'RLE Decrease Strength',
            'lleDecreaseStrength': 'LLE Decrease Strength',
            'rueROM': 'RUE ROM',
            'lueROM': 'LUE ROM',
            'rleROM': 'RLE ROM',
            'lleROM': 'LLE ROM',
            'rueContractures': 'RUE Contractures',
            'lueContractures': 'LUE Contractures',
            'rleContractures': 'RLE Contractures',
            'lleContractures': 'LLE Contractures',
            'rueSensationIntact': 'RUE Sensation Intact',
            'lueSensationIntact': 'LUE Sensation Intact',
            'rleSensationIntact': 'RLE Sensation Intact',
            'lleSensationIntact': 'LLE Sensation Intact',
            
            // Head and Neck Exam
            'normocephalic': 'Normocephalic',
            'eomIntact': 'EOM Intact',
            'facialDrooping': 'Facial Drooping',
            'tracheaMidline': 'Trachea Midline',
            'lungsSound': 'Lungs Sound',
            'axillaryNodes': 'Axillary Nodes',
            'neck': 'Neck',
            'otherArea': 'Other Area',
            'groin': 'Groin',
            'followUpDate': 'Follow Up Date',
            'nose': 'Nose',
            'mouth': 'Mouth',
            'ears': 'Ears',
            'mucousMembrane': 'Mucous Membrane',
            
            // Visit Details and Vitals
            'minsSpent': 'Minutes Spent',
            'signed': 'Signed',
            'vitalsBP': 'Vitals BP',
            'vitalsTemp': 'Vitals Temp',
            'vitalsHeight': 'Vitals Height',
            'vitalsWeight': 'Vitals Weight',
            'vitalsResp': 'Vitals Resp',
            'vitalsPulse': 'Vitals Pulse',
            'fallsType': 'Falls Type',
            'preventiveMeasures': 'Preventive Measures',
            'procedures': 'Procedures',
            'preventiveNotes': 'Preventive Notes',
            'providerDiscussion': 'Provider Discussion',
            'healingDelayedBy': 'Healing Delayed By',
            'aid': 'Aid',
            'treatment': 'Treatment',
            'orientationAO': 'Orientation AO',
            'judgement': 'Judgement',
            'compliant': 'Compliant',
            'planNotes': 'Plan Notes',
            'examNotes': 'Exam Notes',
            'investigationNotes': 'Investigation Notes',
            
            // Special Conditions
            'amputationLLE': 'Amputation LLE',
            'amputationRLE': 'Amputation RLE',
            'isNonVisit': 'Is Non Visit',
            'nonVisitNotes': 'Non Visit Notes',
            'puenomia': 'Pneumonia',
            'puenomiaDate': 'Pneumonia Date',
            'puenomiaReason': 'Pneumonia Reason',
            'pulseLLE': 'Pulse LLE',
            'pulseRLE': 'Pulse RLE',
            'isPodiatry': 'Is Podiatry',
            'isDermatology': 'Is Dermatology',
            'hospice': 'Hospice',
            'syncDate': 'Sync Date',
            'product': 'Product'
        };
        return fieldNames[fieldName] || fieldName;
    }

    function closeEditModal() {
        // Hide the modal
        document.getElementById('editVisitModal').classList.add('hidden');
        
        // Clear all form fields
        clearEditForm();
        
        // Reset tracking variables
        originalVisitData = {};
        currentChanges = {};
        
        // Hide changes tracker
        document.getElementById('changesTracker').style.display = 'none';
    }

    function clearEditForm() {
        const form = document.getElementById('editVisitForm');
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            if (input.type === 'checkbox' || input.type === 'radio') {
                input.checked = false;
            } else {
                input.value = '';
            }
        });
    }

    function saveVisitChanges() {
        if (Object.keys(currentChanges).length === 0) {
            alert('No changes to save.');
            return;
        }

        // Show confirmation modal
        showConfirmationModal();
    }

    function showConfirmationModal() {
        const confirmModal = document.getElementById('confirmModal');
        const confirmChangesList = document.getElementById('confirmChangesList');
        const pccWarning = document.getElementById('pccWarning');
        const isPCC = document.getElementById('editIsPCC').value === '1';

        // Show PCC warning if applicable
        pccWarning.style.display = isPCC ? 'inline' : 'none';

        // Populate changes list
        confirmChangesList.innerHTML = '';
        Object.values(currentChanges).forEach(change => {
            const changeItem = document.createElement('div');
            changeItem.className = 'confirm-change-item';
            changeItem.innerHTML = `
                <span class="confirm-change-field">${getFieldDisplayName(change.field)}</span>
                <span class="confirm-change-value">${change.new}</span>
            `;
            confirmChangesList.appendChild(changeItem);
        });

        confirmModal.classList.remove('hidden');
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function confirmSaveChanges() {
        // Close confirmation modal
        closeConfirmModal();
        
        // Show loading state
        const saveBtn = document.getElementById('saveVisitBtn');
        const originalText = saveBtn.innerHTML;
        saveBtn.innerHTML = '<div class="loading-spinner" style="width: 16px; height: 16px; margin-right: 0.5rem;"></div>Saving...';
        saveBtn.disabled = true;

        // Prepare data for saving
        const formData = new FormData(document.getElementById('editVisitForm'));
        const changesData = {
            visitId: formData.get('visitId'),
            changes: currentChanges
        };

        // Make AJAX call to save changes
        fetch('/visit/save-visit-changes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(changesData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                alert('Visit notes updated successfully! The note will be regenerated.');
                
                // Close edit modal and clear form
                closeEditModal();
                
                // Reload page or refresh data
                window.location.reload();
            } else {
                alert('Error saving changes: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error saving changes:', error);
            alert('Error saving changes. Please try again.');
        })
        .finally(() => {
            // Reset button
            saveBtn.innerHTML = originalText;
            saveBtn.disabled = false;
        });
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const pdfModal = document.getElementById('pdfModal');
        const editModal = document.getElementById('editVisitModal');
        const confirmModal = document.getElementById('confirmModal');
        
        if (event.target === pdfModal) {
            closePDFModal();
        } else if (event.target === editModal) {
            closeEditModal();
        } else if (event.target === confirmModal) {
            closeConfirmModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            if (!document.getElementById('confirmModal').classList.contains('hidden')) {
                closeConfirmModal();
            } else if (!document.getElementById('editVisitModal').classList.contains('hidden')) {
                closeEditModal();
            } else if (!document.getElementById('pdfModal').classList.contains('hidden')) {
                closePDFModal();
            }
        }
    });

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

    // LoadPDF function replaced with openPDFModal for better UX

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