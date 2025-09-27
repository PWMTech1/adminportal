<x-MainLayout>
    <x-slot name="titlePage">
        Edit Facility
    </x-slot>
    <x-slot name="activePage">
        facility-management
    </x-slot>
    @section('content')
    @if(!$facility)
        <div class="error-container">
            <h2>Facility Not Found</h2>
            <p>The requested facility could not be found.</p>
            <a href="{{ route('facility.index') }}" class="btn-back">Back to Facility List</a>
                </div>
    @else
    <style>
        /* Modern Facility Edit Styles */
        .facility-edit-container {
            padding: 2rem;
            background: #f8fafc;
            min-height: 100vh;
        }
        
        .facility-edit-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .facility-edit-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }
        
        .facility-edit-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .btn-back {
            background: #6b7280;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-back:hover {
            background: #4b5563;
            color: white;
            text-decoration: none;
        }
        
        .btn-save {
            background: #10b981;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-save:hover {
            background: #059669;
        }
        
        .form-container {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        
        .form-header {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        
        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
        }
        
        .form-input {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
            font-size: 0.875rem;
            color: #374151;
            transition: all 0.2s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-select {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
            font-size: 0.875rem;
            color: #374151;
            transition: all 0.2s ease;
        }
        
        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .form-checkbox input {
            width: 16px;
            height: 16px;
            accent-color: #3b82f6;
        }
        
        .form-checkbox label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
        }
        
        .table-container {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            margin-bottom: 2rem;
        }
        
        .table-header {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }
        
        .btn-add {
            background: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-add:hover {
            background: #2563eb;
            color: white;
            text-decoration: none;
        }
        
        .modern-table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }
        
        .modern-table th {
            background: #f8fafc;
            padding: 1rem 1.5rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.875rem;
        }
        
        .modern-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        
        .modern-table tr:hover {
            background: #f9fafb;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            white-space: nowrap;
        }
        
        .btn-action {
            padding: 0.5rem;
            border-radius: 6px;
            border: none;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
        }
        
        .btn-edit {
            background: #10b981;
            color: white;
        }
        
        .btn-edit:hover {
            background: #059669;
        }
        
        .btn-delete {
            background: #ef4444;
            color: white;
        }
        
        .btn-delete:hover {
            background: #dc2626;
        }
        
        .btn-search {
            background: #3b82f6;
            color: white;
            padding: 0.25rem;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-search:hover {
            background: #2563eb;
        }
        
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 1rem 0;
        }
        
        .section-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        .modal-container {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        
        .modal-overlay.show .modal-container {
            transform: scale(1);
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }
        
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #6b7280;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        
        .modal-close:hover {
            background: #f3f4f6;
            color: #374151;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }
        
        .btn-cancel {
            background: #6b7280;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-cancel:hover {
            background: #4b5563;
        }
        
        .btn-submit {
            background: #10b981;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-submit:hover {
            background: #059669;
        }
        
        .password-display {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 0.75rem;
            font-family: monospace;
            font-size: 0.875rem;
            color: #374151;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .btn-copy {
            background: #3b82f6;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            border: none;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-copy:hover {
            background: #2563eb;
        }
        
        .btn-submit:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }
        
        /* Clinician Modal Styles */
        .clinician-filters {
            margin-bottom: 20px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        
        .clinicians-list {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
        }
        
        .clinician-item {
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.2s ease;
        }
        
        .clinician-item:last-child {
            border-bottom: none;
        }
        
        .clinician-item:hover {
            background-color: #f8fafc;
        }
        
        .clinician-item[style*="display: none"] {
            display: none !important;
        }
        
        .no-results-message {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
            font-style: italic;
            border: 1px dashed #d1d5db;
            border-radius: 8px;
            margin: 1rem 0;
            background-color: #f9fafb;
        }
        
        .attached-badge {
            display: inline-block;
            background-color: #10b981;
            color: white;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            margin-left: 0.5rem;
        }
        
        .clinician-checkbox input[type="checkbox"]:checked {
            background-color: #10b981;
            border-color: #10b981;
        }
        
        .clinician-item.changed {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
        }
        
        .clinician-item.changed .clinician-name::after {
            content: " (Changed)";
            color: #f59e0b;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .clinician-checkbox {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            cursor: pointer;
            margin: 0;
            position: relative;
        }
        
        .clinician-checkbox input[type="checkbox"] {
            margin-right: 15px;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .clinician-info {
            flex: 1;
        }
        
        .clinician-name {
            font-weight: 600;
            color: #1f2937;
            font-size: 16px;
            margin-bottom: 4px;
        }
        
        .clinician-email {
            color: #6b7280;
            font-size: 14px;
        }
        
        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-row .form-group:only-child {
            grid-column: 1 / -1;
        }
        
        .form-row .form-group:nth-child(2):last-child {
            grid-column: 1 / 3;
        }
        
        .form-select {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 0.75rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 100%;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
        
        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-select option {
            background-color: #ffffff;
            color: #374151;
            padding: 0.5rem;
        }
        
        .form-select:disabled {
            background-color: #f9fafb;
            color: #6b7280;
            cursor: not-allowed;
            border-color: #e5e7eb;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        .error-container {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 2rem;
        }
        
        .error-container h2 {
            color: #dc2626;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .error-container p {
            color: #6b7280;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        
        .btn-submit:disabled:hover {
            background: #9ca3af;
        }
    </style>

    <div class="facility-edit-container">
        <!-- Header Section -->
        <div class="facility-edit-header">
            <h1 class="facility-edit-title">Edit Facility</h1>
            <div class="facility-edit-actions">
                <a href="/facility/list" class="btn-back">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"></path>
                    </svg>
                    Back to List
                </a>
                <button type="submit" form="facilityForm" class="btn-save">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Save Facility
                </button>
                </div>
        </div>
        
        <!-- Facility Form -->
        <div class="form-container">
            <div class="form-header">
                <h3 class="form-title">Facility Information</h3>
                </div>
            
            <form method="POST" action="/forms/mileage" autocomplete="off" id="facilityForm" enctype="multipart/form-data">
                    @csrf
                    {{ csrf_field() }}
                    @method('post')
                <input type="hidden" value="{{ $facility->Id }}" id="hdnFacilityId">
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Facility Name *</label>
                        <input type="text" class="form-input" name="name" id="name" 
                               placeholder="Enter facility name"
                               value="{{ !empty($facility) ? $facility->Name : '' }}" 
                               required>
                                </div>
                    
                    <div class="form-group">
                        <label class="form-label">Address 1 *</label>
                        <input type="text" class="form-input" name="address1" id="address1" 
                               placeholder="Enter address"
                               value="{{ !empty($facility) ? $facility->Address1 : '' }}" 
                               required>
                                </div>
                    
                    <div class="form-group">
                        <label class="form-label">Address 2</label>
                        <input type="text" class="form-input" name="address2" id="address2" 
                               placeholder="Enter address line 2"
                                        value="{{ !empty($facility) ? $facility->Address2 : '' }}">
                            </div>
                    
                    <div class="form-group">
                        <label class="form-label">City *</label>
                        <input type="text" class="form-input" name="city" id="city" 
                               placeholder="Enter city"
                               value="{{ !empty($facility) ? $facility->City : '' }}" 
                               required>
                                </div>
                    
                    <div class="form-group">
                        <label class="form-label">State *</label>
                        <select class="form-select" name="state" id="state" required>
                            <option value="">Select State</option>
                                        @foreach ($State as $s)
                                            @if (!empty($facility) && $facility->State == $s->Abbreviation)
                                    <option value="{{ $s->Abbreviation }}" selected>{{ $s->Description }}</option>
                                            @else
                                    <option value="{{ $s->Abbreviation }}">{{ $s->Description }}</option>
                                            @endif
                                        @endforeach
                        </select>
                                </div>
                    
                    <div class="form-group">
                        <label class="form-label">Zip Code *</label>
                        <input type="text" class="form-input" name="zipcode" id="zipcode" 
                               placeholder="Enter zip code"
                               value="{{ !empty($facility) ? $facility->Zipcode5 : '' }}" 
                               required>
                                </div>
                    
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-input" name="phone" id="phone" 
                               placeholder="Enter phone number"
                                        value="{{ !empty($facility) ? $facility->Phone : '' }}">
                            </div>
                    
                    <div class="form-group">
                        <label class="form-label">Fax</label>
                        <input type="text" class="form-input" name="fax" id="fax" 
                               placeholder="Enter fax number"
                                        value="{{ !empty($facility) ? $facility->Fax : '' }}">
                                </div>
                    
                    <div class="form-group">
                        <label class="form-label">Facility Type *</label>
                        <select class="form-select" name="type" id="type" required>
                            <option value="">Select Type</option>
                                        @if (!empty($facility) && $facility->FacilityType == 'SNF')
                                <option value="SNF" selected>SNF</option>
                                        @else
                                <option value="SNF">SNF</option>
                                        @endif
                                        @if (!empty($facility) && $facility->FacilityType == 'ALF')
                                <option value="ALF" selected>ALF</option>
                                        @else
                                <option value="ALF">ALF</option>
                                        @endif
                        </select>
                                </div>
                    
                    <div class="form-group">
                        <div class="form-checkbox">
                                    @if (!empty($facility) && $facility->IsPCC)
                                <input type="checkbox" name="ispcc" id="ispcc" checked disabled>
                                    @else
                                <input type="checkbox" name="ispcc" id="ispcc" disabled>
                                    @endif
                            <label for="ispcc">Is PCC</label>
                                </div>
                            </div>
                        </div>
                </form>
                    </div>

        <!-- Contact List Section -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">Contact List</h3>
                <button type="button" class="btn-add" onclick="openAddContactModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Add New Contact
                </button>
                    </div>
            
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Fax</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($facility->contacts as $c)
                            <tr>
                                <td>{{ $c->firstname . ' ' . $c->middlename . ' ' . $c->lastname }}</td>
                                <td>{{ $c->Title }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->Phone }}</td>
                                <td>{{ $c->Fax }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn-action btn-edit" title="Edit Contact"
                                            @click="$dispatch('modal', {clinicianid: {{ $c->id }}, open: true, Type: 'user', Title: 'Edit Contact'})">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </button>
                                        <button type="button" class="btn-action btn-delete" title="Delete Contact" onclick="deleteContact({{ $c->id }}, '{{ $c->firstname }} {{ $c->lastname }}')">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    
                </tbody>
            </table>
        </div>
        
        <!-- Clinician List Section -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">Clinician List</h3>
                <button type="button" class="btn-add" onclick="openAttachClinicianModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Attach Clinician
                </button>
            </div>
            
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Fax</th>
                        <th>NPI</th>
                        <th>Clinician Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($facility->clinicians as $c)
                            <tr>
                                <td>{{ $c->firstname . ' ' . $c->middlename . ' ' . $c->lastname }}</td>
                                <td>{{ $c->Title }}</td>
                                <td>{{ $c->Phone }}</td>
                                <td>{{ $c->Fax }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    {{ $c->NPI }}
                                        <a href="https://npiregistry.cms.hhs.gov/" class="btn-search" title="Search NPI" target="_blank">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </a>
                                    </div>
                                </td>
                                <td>{{ $c->pivot->ClinicianType }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn-action btn-edit" title="Edit Clinician"
                                                @click="$dispatch('modal',{clinicianid: {{ $c->id }}, open: true, Type: 'clinician', Title: 'Edit Clinician'})">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    
                </tbody>
            </table>
        </div>
        
        <!-- Modal Include -->
        @include('PartialView.Modal')
        
        <!-- Add Contact Modal -->
        <div id="addContactModal" class="modal-overlay">
            <div class="modal-container">
                <div class="modal-header">
                    <h3 class="modal-title">Add New Contact</h3>
                    <button type="button" class="modal-close" onclick="closeAddContactModal()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form id="addContactForm" class="modal-form">
                        <div class="form-group">
                            <label class="form-label">First Name *</label>
                            <input type="text" class="form-input" name="firstname" id="contactFirstname" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-input" name="middlename" id="contactMiddlename">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Last Name *</label>
                            <input type="text" class="form-input" name="lastname" id="contactLastname" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Role *</label>
                            <select class="form-select" name="role" id="contactRole" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->Id }}">{{ $role->Description }}</option>
                    @endforeach
                            </select>
        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-input" name="email" id="contactEmail" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Auto-Generated Password *</label>
                            <div class="password-display">
                                <span id="generatedPassword">Click Generate to create password</span>
                                <button type="button" class="btn-copy" onclick="generatePassword()">Generate</button>
                            </div>
                            <small style="color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem; display: block;">
                                Password must be generated before saving the contact.
                            </small>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-checkbox">
                                <input type="checkbox" name="isactive" id="contactIsActive" checked>
                                <label for="contactIsActive">Active</label>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeAddContactModal()">Cancel</button>
                    <button type="button" class="btn-submit" onclick="submitAddContact()">Add Contact</button>
                </div>
            </div>
        </div>
        </div>

        <!-- Attach Clinician Modal -->
        <div id="attachClinicianModal" class="modal-overlay">
            <div class="modal-container" style="max-width: 800px;">
                <div class="modal-header">
                    <h3 class="modal-title">Attach Clinicians</h3>
                    <button type="button" class="modal-close" onclick="closeAttachClinicianModal()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="clinician-filters">
                        <div class="form-group">
                            <label class="form-label">Search Clinicians</label>
                            <input type="text" class="form-input" id="clinicianSearch" placeholder="Search by name or email...">
                        </div>
                    </div>
                    
                    <div class="clinicians-list" id="cliniciansList">
                        <!-- Clinicians will be loaded here -->
                    </div>
                    
                    <div class="modal-actions">
                        <button type="button" class="btn-cancel" onclick="closeAttachClinicianModal()">Cancel</button>
                        <button type="button" class="btn-add" onclick="openAddClinicianModal()">Add New Clinician</button>
                        <button type="button" class="btn-submit" id="attachCliniciansBtn" onclick="submitAttachClinicians()">Attach Selected</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New Clinician Modal -->
        <div id="addClinicianModal" class="modal-overlay">
            <div class="modal-container" style="max-width: 900px; max-height: 90vh; overflow-y: auto;">
                <div class="modal-header">
                    <h3 class="modal-title">Add New Clinician</h3>
                    <button type="button" class="modal-close" onclick="closeAddClinicianModal()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form id="addClinicianForm">
                        <input type="hidden" name="facility_id" value="{{ $facility->Id }}">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">First Name *</label>
                                <input type="text" class="form-input" name="firstname" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-input" name="middlename">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Last Name *</label>
                                <input type="text" class="form-input" name="lastname" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Role *</label>
                                <select class="form-select" name="role" required disabled>
                                    <option value="1" selected>Clinician</option>
                                </select>
                                <input type="hidden" name="role" value="1">
                                <small style="color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem; display: block;">
                                    Clinicians are automatically assigned the Clinician role.
                                </small>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-input" name="email" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Auto-Generated Password *</label>
                            <div class="password-display">
                                <span id="clinicianPasswordDisplay">Click Generate to create password</span>
                                <button type="button" class="btn-copy" onclick="generateClinicianPassword()">Generate</button>
                            </div>
                            <input type="hidden" name="password" id="clinicianPassword">
                            <small style="color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem; display: block;">
                                Password must be generated before saving the clinician.
                            </small>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-checkbox">
                                <input type="checkbox" name="isactive" checked>
                                <label>Active</label>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">NPI Number</label>
                                <input type="text" class="form-input" name="npi">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-input" name="phone">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Fax</label>
                                <input type="tel" class="form-input" name="fax">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-input" name="address">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Address 2</label>
                            <input type="text" class="form-input" name="address2">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <input type="text" class="form-input" name="city">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">State</label>
                                <select class="form-select" name="state">
                                    <option value="">Select State</option>
                                    @foreach($State as $s)
                                        <option value="{{ $s->StateCode }}">{{ $s->StateName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-input" name="zipcode">
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeAddClinicianModal()">Cancel</button>
                    <button type="button" class="btn-submit" id="addClinicianBtn" onclick="submitAddClinician()">Add Clinician</button>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function clinicianSearch() {
                return {
                    IsLoading: false,
                    open: false,
                    clinicianid: 0,
                    url: "",
                    clinician: null,
                    Type: "",
                    Title: "",
                    fetchClinician() {
                        this.IsLoading = true;
                        switch (this.Type) {
                            case "clinician":
                                url = `/getcliniciandetails/${this.clinicianid}`;
                                break;
                            case "user":
                                url = `/getcontactdetails/${this.clinicianid}`;
                                break;
                        }
                        fetch(url)
                            .then((response) => response.json())
                            .then((html) => {
                                this.IsLoading = false;
                                this.clinician = html;
                            })
                            .catch((err) => console.log("ERROR", err));
                    },
                    closeClinician() {
                        this.open = false;
                        this.clinicianid = 0;
                        this.url = "";
                        this.clinician = null;
                        this.Type = "";
                        this.Title = "";
                    }
                };
            }
        
        // Add Contact Modal Functions
        function openAddContactModal() {
            document.getElementById('addContactModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            // Clear form
            document.getElementById('addContactForm').reset();
            document.getElementById('generatedPassword').textContent = 'Click Generate to create password';
        }
        
        function closeAddContactModal() {
            document.getElementById('addContactModal').classList.remove('show');
            document.body.style.overflow = '';
        }
        
        function generatePassword() {
            const length = 12;
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
            let password = "";
            
            // Ensure at least one character from each category
            password += "abcdefghijklmnopqrstuvwxyz"[Math.floor(Math.random() * 26)]; // lowercase
            password += "ABCDEFGHIJKLMNOPQRSTUVWXYZ"[Math.floor(Math.random() * 26)]; // uppercase
            password += "0123456789"[Math.floor(Math.random() * 10)]; // number
            password += "!@#$%^&*"[Math.floor(Math.random() * 8)]; // special char
            
            // Fill the rest randomly
            for (let i = password.length; i < length; i++) {
                password += charset[Math.floor(Math.random() * charset.length)];
            }
            
            // Shuffle the password
            password = password.split('').sort(() => Math.random() - 0.5).join('');
            
            document.getElementById('generatedPassword').textContent = password;
        }
        
        async function submitAddContact() {
            const form = document.getElementById('addContactForm');
            const formData = new FormData(form);
            
            // Get the generated password
            const password = document.getElementById('generatedPassword').textContent;
            if (password === 'Click Generate to create password') {
                alert('Please generate a password first.');
                return;
            }
            
            // Add password to form data
            formData.append('password', password);
            formData.append('facility_id', document.getElementById('hdnFacilityId').value);
            
            // Validate required fields
            const requiredFields = ['firstname', 'lastname', 'role', 'email'];
            for (let field of requiredFields) {
                if (!formData.get(field)) {
                    alert(`Please fill in the ${field} field.`);
                    return;
                }
            }
            
            // Validate email format
            const email = formData.get('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            
            // Get button reference and set loading state
            const submitBtn = document.querySelector('.btn-submit');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Creating...';
            submitBtn.disabled = true;
            
            // Function to reset button state
            function resetButtonState() {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
            
            try {
                // Send data to backend
                const response = await fetch('/facility/save-contact', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    alert(data.message);
                    closeAddContactModal();
                    // Refresh the page to show the new contact
                    location.reload();
                } else {
                    // Reset button state before showing error
                    resetButtonState();
                    
                    // Handle different types of errors
                    if (data.errors) {
                        // Validation errors
                        let errorMessage = 'Please fix the following errors:\n';
                        for (let field in data.errors) {
                            errorMessage += `• ${data.errors[field].join(', ')}\n`;
                        }
                        alert(errorMessage);
                    } else {
                        // Other errors (like duplicate email)
                        alert(data.message);
                    }
                    // Don't close modal on errors - let user fix the issues
                }
                
            } catch (error) {
                console.error('Error:', error);
                // Reset button state before showing error
                resetButtonState();
                alert('Failed to create contact. Please try again.');
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('addContactModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddContactModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('addContactModal').classList.contains('show')) {
                closeAddContactModal();
            }
        });
        
        // Delete contact function
        async function deleteContact(userId, contactName) {
            // Show confirmation dialog
            if (!confirm(`Are you sure you want to delete the contact "${contactName}"?\n\nThis action cannot be undone.`)) {
                return;
            }
            
            try {
                // Show loading state (optional - could add a loading indicator)
                console.log('Deleting contact...');
                
                // Send delete request
                const response = await fetch(`/facility/delete-contact/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    alert(data.message);
                    // Refresh the page to show updated contact list
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
                
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to delete contact. Please try again.');
            }
        }

        // Attach Clinician Modal Functions
        function openAttachClinicianModal() {
            document.getElementById('attachClinicianModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            loadCliniciansData();
        }

        function closeAttachClinicianModal() {
            document.getElementById('attachClinicianModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        function openAddClinicianModal() {
            document.getElementById('addClinicianModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            generateClinicianPassword();
        }

        function closeAddClinicianModal() {
            document.getElementById('addClinicianModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        async function loadCliniciansData() {
            try {
                const facilityId = {{ $facility->Id }};
                const response = await fetch(`/facility/get-clinicians?facility_id=${facilityId}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                });
                
                const data = await response.json();
                populateCliniciansList(data.clinicians);
            } catch (error) {
                console.error('Error loading clinicians:', error);
                alert('Failed to load clinicians. Please try again.');
            }
        }

        // Track original state and changes
        let originalClinicianStates = {};
        let changedClinicians = new Set();

        function populateCliniciansList(clinicians) {
            const container = document.getElementById('cliniciansList');
            container.innerHTML = '';
            
            // Reset tracking
            originalClinicianStates = {};
            changedClinicians.clear();
            
            clinicians.forEach(clinician => {
                const div = document.createElement('div');
                div.className = 'clinician-item';
                const isChecked = clinician.isAttached ? 'checked' : '';
                const attachedBadge = clinician.isAttached ? '<span class="attached-badge">Already Attached</span>' : '';
                
                // Store original state
                originalClinicianStates[clinician.id] = clinician.isAttached;
                
                div.innerHTML = `
                    <label class="clinician-checkbox">
                        <input type="checkbox" value="${clinician.id}" class="clinician-select" ${isChecked} data-original-state="${clinician.isAttached}">
                        <span class="checkmark"></span>
                        <div class="clinician-info">
                            <div class="clinician-name">${clinician.firstname} ${clinician.lastname} ${attachedBadge}</div>
                            <div class="clinician-email">${clinician.email}</div>
                        </div>
                    </label>
                `;
                container.appendChild(div);
            });
            
            // Add change tracking event listeners
            addChangeTrackingListeners();
        }

        function addChangeTrackingListeners() {
            const checkboxes = document.querySelectorAll('.clinician-select');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const clinicianId = this.value;
                    const originalState = this.getAttribute('data-original-state') === 'true';
                    const currentState = this.checked;
                    const clinicianItem = this.closest('.clinician-item');
                    
                    if (originalState !== currentState) {
                        changedClinicians.add(clinicianId);
                        clinicianItem.classList.add('changed');
                    } else {
                        changedClinicians.delete(clinicianId);
                        clinicianItem.classList.remove('changed');
                    }
                    
                    updateSubmitButtonState();
                });
            });
        }

        function updateSubmitButtonState() {
            const submitBtn = document.getElementById('attachCliniciansBtn');
            if (changedClinicians.size > 0) {
                submitBtn.textContent = `Attach Changes (${changedClinicians.size})`;
                submitBtn.disabled = false;
            } else {
                submitBtn.textContent = 'Attach Selected';
                submitBtn.disabled = true;
            }
        }

        function filterClinicians() {
            const searchTerm = document.getElementById('clinicianSearch').value.toLowerCase();
            const clinicianItems = document.querySelectorAll('.clinician-item');
            const container = document.getElementById('cliniciansList');
            
            let visibleCount = 0;
            
            clinicianItems.forEach(item => {
                const name = item.querySelector('.clinician-name').textContent.toLowerCase();
                const email = item.querySelector('.clinician-email').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || email.includes(searchTerm)) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show/hide "No results" message
            let noResultsMsg = document.getElementById('noResultsMessage');
            if (visibleCount === 0 && searchTerm.length > 0) {
                if (!noResultsMsg) {
                    noResultsMsg = document.createElement('div');
                    noResultsMsg.id = 'noResultsMessage';
                    noResultsMsg.className = 'no-results-message';
                    noResultsMsg.innerHTML = '<p>No clinicians found matching your search.</p>';
                    container.appendChild(noResultsMsg);
                }
                noResultsMsg.style.display = 'block';
            } else if (noResultsMsg) {
                noResultsMsg.style.display = 'none';
            }
        }

        function generateClinicianPassword() {
            const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
            let password = '';
            for (let i = 0; i < 12; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('clinicianPassword').value = password;
            document.getElementById('clinicianPasswordDisplay').textContent = password;
        }

        async function submitAttachClinicians() {
            if (changedClinicians.size === 0) {
                alert('No changes detected. Please make changes before submitting.');
                return;
            }

            // Process only changed clinicians
            const toAttach = [];
            const toDetach = [];
            
            changedClinicians.forEach(clinicianId => {
                const checkbox = document.querySelector(`input[value="${clinicianId}"]`);
                const originalState = checkbox.getAttribute('data-original-state') === 'true';
                const currentState = checkbox.checked;
                
                if (!originalState && currentState) {
                    // Was not attached, now checked - attach
                    toAttach.push(clinicianId);
                } else if (originalState && !currentState) {
                    // Was attached, now unchecked - detach
                    toDetach.push(clinicianId);
                }
            });

            if (toAttach.length === 0 && toDetach.length === 0) {
                alert('No valid changes to process.');
                return;
            }

            const submitBtn = document.getElementById('attachCliniciansBtn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Processing Changes...';
            submitBtn.disabled = true;

            try {
                const response = await fetch('/facility/attach-clinicians', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        facility_id: {{ $facility->Id }},
                        to_attach: toAttach,
                        to_detach: toDetach
                    })
                });

                const data = await response.json();
                
                if (data.success) {
                    let message = data.message;
                    if (toAttach.length > 0 && toDetach.length > 0) {
                        message += ` (${toAttach.length} attached, ${toDetach.length} detached)`;
                    } else if (toAttach.length > 0) {
                        message += ` (${toAttach.length} attached)`;
                    } else if (toDetach.length > 0) {
                        message += ` (${toDetach.length} detached)`;
                    }
                    alert(message);
                    closeAttachClinicianModal();
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to process changes. Please try again.');
            } finally {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        }

        async function submitAddClinician() {
            const form = document.getElementById('addClinicianForm');
            const formData = new FormData(form);
            
            // Client-side validation
            if (!formData.get('firstname') || !formData.get('lastname') || !formData.get('email') || !formData.get('password')) {
                alert('Please fill in all required fields.');
                return;
            }

            const submitBtn = document.getElementById('addClinicianBtn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Creating...';
            submitBtn.disabled = true;

            try {
                const response = await fetch('/facility/save-clinician', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData
                });

                const data = await response.json();
                
                if (data.success) {
                    alert(data.message);
                    closeAddClinicianModal();
                    closeAttachClinicianModal();
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to create clinician. Please try again.');
            } finally {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
            }

        // Add event listeners for modal interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Close modals when clicking outside
            document.getElementById('attachClinicianModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAttachClinicianModal();
                }
            });

            document.getElementById('addClinicianModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAddClinicianModal();
                }
            });

            // Close modals with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAttachClinicianModal();
                    closeAddClinicianModal();
                }
            });

            // Add search functionality
            const searchInput = document.getElementById('clinicianSearch');
            if (searchInput) {
                searchInput.addEventListener('input', filterClinicians);
            }
        });
        </script>
    @endif
    @endsection
</x-MainLayout>
