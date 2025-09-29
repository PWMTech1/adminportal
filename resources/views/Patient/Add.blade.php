<x-MainLayout>
    <x-slot name="titlePage">
        Add New Patient
    </x-slot>
    <x-slot name="activePage">
        addpatient
    </x-slot>
    @section('content')
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    
    <div class="patient-container">
        <div class="patient-header">
            <h1 class="patient-title">Add New Patient</h1>
            <div class="patient-actions">
                <a href="/patient/list" class="btn-back">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"></path>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Patient List
                </a>
            </div>
        </div>

        <div class="patient-form-container">
            <form method="post" action="{{route('savepatient')}}" enctype="multipart/form-data" class="patient-form">
                @csrf
                
                <!-- Patient Number Display -->
                <div class="form-section">
                    <h3 class="section-title">Patient Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Patient Number</label>
                            <div class="form-display">
                                <input type="hidden" value="{{$mrnumber}}" name="mrnumber">
                                <span class="patient-number">{{$mrnumber}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="form-section">
                    <h3 class="section-title">Personal Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">First Name <span class="required">*</span></label>
                            <input type="text" 
                                class="form-input {{ $errors->has('firstname') ? 'error' : ''}}"
                                placeholder="Enter first name" 
                                name="firstname" 
                                id="firstname"
                                value="{{old('firstname')}}"
                                required>
                            @if($errors->has('firstname'))
                                <span class="error-message">{{ $errors->first('firstname') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Last Name <span class="required">*</span></label>
                            <input type="text" 
                                class="form-input {{ $errors->has('lastname') ? 'error' : ''}}"
                                placeholder="Enter last name" 
                                name="lastname" 
                                id="lastname"
                                value="{{old('lastname')}}"
                                required>
                            @if($errors->has('lastname'))
                                <span class="error-message">{{ $errors->first('lastname') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Middle Name</label>
                            <input type="text" 
                                class="form-input"
                                placeholder="Enter middle name" 
                                name="middlename" 
                                id="middlename"
                                value="{{old('middlename')}}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Date of Birth <span class="required">*</span></label>
                            <input type="text" 
                                class="datepicker form-input {{ $errors->has('dob') ? 'error' : ''}}"
                                placeholder="Select date of birth" 
                                name="dob" 
                                id="dob"
                                value="{{old('dob')}}"
                                required>
                            @if($errors->has('dob'))
                                <span class="error-message">{{ $errors->first('dob') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Gender <span class="required">*</span></label>
                            <select class="form-select {{ $errors->has('gender') ? 'error' : ''}}" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female</option>
                                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Male</option>
                            </select>
                            @if($errors->has('gender'))
                                <span class="error-message">{{ $errors->first('gender') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">SSN</label>
                            <input type="text" 
                                class="form-input"
                                placeholder="Enter SSN" 
                                name="ssn" 
                                id="ssn" 
                                value="{{old('ssn')}}">
                        </div>
                    </div>
                </div>

                <!-- Facility Information -->
                <div class="form-section">
                    <h3 class="section-title">Facility Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Facility <span class="required">*</span></label>
                            <select class="form-select {{ $errors->has('facilityname') ? 'error' : ''}}" name="facilityname" id="facilityname" required>
                                <option value="">Select Facility</option>
                                @foreach($facility as $f)
                                <option value="{{$f->Id}}" {{ old('facilityname') == $f->Id ? 'selected' : '' }}>
                                    {{$f->Name}}
                                </option>
                                @endforeach
                            </select>
                            @if($errors->has('facilityname'))
                                <span class="error-message">{{ $errors->first('facilityname') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Admission Date <span class="required">*</span></label>
                            <input type="text" 
                                class="datepicker form-input {{ $errors->has('admissiondate') ? 'error' : ''}}"
                                placeholder="Select admission date" 
                                name="admissiondate"
                                id="admissiondate" 
                                value="{{old('admissiondate')}}"
                                required>
                            @if($errors->has('admissiondate'))
                                <span class="error-message">{{ $errors->first('admissiondate') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Room</label>
                            <input type="text" 
                                class="form-input" 
                                placeholder="Enter room number" 
                                name="room" 
                                id="room" 
                                value="{{old('room')}}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Bed</label>
                            <input type="text" 
                                class="form-input" 
                                placeholder="Enter bed number" 
                                name="bed" 
                                id="bed" 
                                value="{{old('bed')}}">
                        </div>
                    </div>
                </div>

                <!-- Demographics -->
                <div class="form-section">
                    <h3 class="section-title">Demographics</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Language</label>
                            <select class="form-select" name="language" id="language">
                                <option value="">Select Language</option>
                                @foreach($language as $l)
                                <option value="{{$l->Description}}" {{ old('language') == $l->Description ? 'selected' : '' }}>
                                    {{$l->Description}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Religion</label>
                            <select class="form-select" name="religion" id="religion">
                                <option value="">Select Religion</option>
                                @foreach($religion as $r)
                                <option value="{{$r->Description}}" {{ old('religion') == $r->Description ? 'selected' : '' }}>
                                    {{$r->Description}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Sexual Orientation</label>
                            <select class="form-select" name="sexualorientation" id="sexualorientation">
                                <option value="">Select Sexual Orientation</option>
                                <option value="1" {{ old('sexualorientation') == '1' ? 'selected' : '' }}>Bisexual</option>
                                <option value="2" {{ old('sexualorientation') == '2' ? 'selected' : '' }}>Choose not to Disclose</option>
                                <option value="3" {{ old('sexualorientation') == '3' ? 'selected' : '' }}>Lesbian or Gay or Homosexual</option>
                                <option value="4" {{ old('sexualorientation') == '4' ? 'selected' : '' }}>Other</option>
                                <option value="5" {{ old('sexualorientation') == '5' ? 'selected' : '' }}>Straight or Heterosexual</option>
                                <option value="6" {{ old('sexualorientation') == '6' ? 'selected' : '' }}>Unknown</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Communication</label>
                            <select class="form-select" name="communication" id="communication">
                                <option value="">Select Communication Method</option>
                                @foreach($communication as $c)
                                <option value="{{$c->Description}}" {{ old('communication') == $c->Description ? 'selected' : '' }}>
                                    {{$c->Description}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Insurance Information -->
                <div class="form-section">
                    <h3 class="section-title">Insurance Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Primary Insurance</label>
                            <input type="text" 
                                class="form-input"
                                placeholder="Enter primary insurance" 
                                name="primaryinsurance"
                                id="primaryinsurance" 
                                value="{{old('PrimaryInsurance')}}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Primary Policy Number</label>
                            <input type="text" 
                                class="form-input"
                                placeholder="Enter policy number" 
                                name="policynumber"
                                id="policynumber" 
                                value="{{old('PolicyNumber')}}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Secondary Insurance</label>
                            <input type="text" 
                                class="form-input"
                                placeholder="Enter secondary insurance" 
                                name="SecondaryInsurance"
                                id="secondaryinsurance"
                                value="{{old('secondaryinsurance')}}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Secondary Policy Number</label>
                            <input type="text" 
                                class="form-input"
                                placeholder="Enter policy number" 
                                name="policynumber2"
                                id="policynumber2" 
                                value="{{old('PolicyNumber2')}}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tertiary Insurance</label>
                            <input type="text" 
                                class="form-input"
                                placeholder="Enter tertiary insurance" 
                                name="tetriaryinsurance"
                                id="tetriaryinsurance" 
                                value="{{old('TetriaryInsurance')}}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tertiary Policy Number</label>
                            <input type="text" 
                                class="form-input"
                                placeholder="Enter policy number" 
                                name="policynumber3"
                                id="policynumber3" 
                                value="{{old('PolicyNumber3')}}">
                        </div>
                    </div>
                </div>

                <!-- Document Upload -->
                <div class="form-section">
                    <h3 class="section-title">Document Upload</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Facesheet <span class="required">*</span></label>
                            <div class="file-upload-container">
                                <input type="file" 
                                    class="form-file" 
                                    name='facesheet'
                                    id="facesheet"
                                    required
                                    accept=".pdf,.jpg,.jpeg,.png">
                                <label for="facesheet" class="file-upload-label">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    <span>Choose File</span>
                                </label>
                                <div class="file-name" id="fileName"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="window.history.back()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Cancel
                    </button>
                    <button type="submit" class="btn-save">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17,21 17,13 7,13 7,21"></polyline>
                            <polyline points="7,3 7,8 15,8"></polyline>
                        </svg>
                        Save Patient
                    </button>
                </div>

                @if(session()->has('message'))
                <div class="alert alert-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 12l2 2 4-4"></path>
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    {{ session()->get('message') }}
                </div>
                @endif
            </form>
        </div>
    </div>

    <style>
    .patient-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem;
    }

    .patient-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        background: white;
        padding: 1.5rem 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .patient-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .patient-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .btn-back {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        background: #6b7280;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #4b5563;
        color: white;
        text-decoration: none;
    }

    .patient-form-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .patient-form {
        padding: 2rem;
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

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
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

    .required {
        color: #dc2626;
    }

    .form-input, .form-select {
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background: white;
    }

    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input.error, .form-select.error {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .form-display {
        padding: 0.75rem;
        background: #f3f4f6;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-weight: 600;
        color: #374151;
    }

    .patient-number {
        font-size: 1.125rem;
        color: #3b82f6;
    }

    .file-upload-container {
        position: relative;
    }

    .form-file {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem;
        border: 2px dashed #d1d5db;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #f9fafb;
    }

    .file-upload-label:hover {
        border-color: #3b82f6;
        background: #f0f9ff;
    }

    .file-name {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding: 2rem 0;
        border-top: 1px solid #e5e7eb;
        margin-top: 2rem;
    }

    .btn-cancel, .btn-save {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-cancel {
        background: #6b7280;
        color: white;
    }

    .btn-cancel:hover {
        background: #4b5563;
    }

    .btn-save {
        background: #10b981;
        color: white;
    }

    .btn-save:hover {
        background: #059669;
    }

    .alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-top: 1rem;
        font-weight: 500;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    @media (max-width: 768px) {
        .patient-container {
            padding: 1rem;
        }

        .patient-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .patient-actions {
            justify-content: center;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }
    }
    </style>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.datepicker').datepicker();
        
        // File upload handling
        $('#facesheet').change(function() {
            const fileName = $(this).val().split('\\').pop();
            $('#fileName').text(fileName ? `Selected: ${fileName}` : '');
        });
    });
    </script>
    @endsection
</x-MainLayout>