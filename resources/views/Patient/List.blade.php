<x-MainLayout>
    <x-slot name="titlePage">
        Patient List
    </x-slot>
    <x-slot name="activePage">
        PatientList
    </x-slot>
    @section('content')
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    
    <div class="patient-list-container">
        <!-- Header Section -->
        <div class="patient-list-header">
            <div class="header-content">
                <h1 class="page-title">Patient List</h1>
                <div class="header-actions">
                    <a href="/addpatient" class="btn-add-patient">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add New Patient
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="GET" action="/patient/list" class="filter-form">
                <div class="filter-grid">
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
                        <label class="filter-label">Patient Name</label>
                        <input type="text" 
                            name='patientname'
                            class="filter-input"
                            placeholder="Enter patient name" 
                            value="{{ $patientname }}">
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Entity</label>
                        <select class="filter-select" name="entities" id="entities">
                            <option value="-1">Select Entity</option>
                            @foreach ($entity as $e)
                                @if ($entities == $e->index && Str::length($entities) > 0)
                                    <option value="{{ $e->index }}" selected="selected">
                                        {{ $e->Entity . ' - ' . $e->State }}
                                    </option>
                                @else
                                    <option value="{{ $e->index }}">
                                        {{ $e->Entity . ' - ' . $e->State }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            Filter Results
                        </button>
                        <a href="/patient/list" class="btn-clear">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                            Clear Filters
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results Section -->
        <div class="results-section">
            <div class="results-header">
                <div class="results-info">
                    <h3 class="results-title">Patient Records</h3>
                    <span class="results-count">{{ $paginator->total() }} patients found</span>
                </div>
            </div>

            <!-- Table Container -->
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="patient-table">
                        <thead>
                            <tr>
                                <th class="table-header">
                                    <div class="header-content">
                                        <span>Patient ID</span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"></path>
                                            <path d="M7 12h10"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="table-header">
                                    <div class="header-content">
                                        <span>Patient Name</span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"></path>
                                            <path d="M7 12h10"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="table-header">
                                    <div class="header-content">
                                        <span>Facility</span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"></path>
                                            <path d="M7 12h10"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="table-header">
                                    <div class="header-content">
                                        <span>SSN</span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"></path>
                                            <path d="M7 12h10"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="table-header">
                                    <div class="header-content">
                                        <span>PCC Status</span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"></path>
                                            <path d="M7 12h10"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="table-header">
                                    <div class="header-content">
                                        <span>Actions</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paginator as $patient)
                            <tr class="table-row">
                                <td class="table-cell">
                                    <div class="patient-id">
                                        <span class="id-label">ID</span>
                                        <span class="id-value">{{ $patient['MRNumber'] }}</span>
                                    </div>
                                </td>
                                <td class="table-cell">
                                    <div class="patient-name">
                                        <div class="name-primary">
                                            {{ $patient['FirstName'] . ' ' . $patient['MiddleName'] . ' ' . $patient['LastName'] }}
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">
                                    <div class="facility-info">
                                        <span class="facility-name">{{ $patient['FacilityName'] }}</span>
                                    </div>
                                </td>
                                <td class="table-cell">
                                    <div class="ssn-info">
                                        <span class="ssn-value">{{ $patient['SSN'] }}</span>
                                    </div>
                                </td>
                                <td class="table-cell">
                                    <div class="pcc-status">
                                        @if ($patient['IsPCC'])
                                            <span class="status-badge status-active">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                PCC
                                            </span>
                                        @else
                                            <span class="status-badge status-inactive">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                                Non-PCC
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="table-cell">
                                    <div class="action-buttons">
                                        <button class="btn-action btn-view" title="View Patient">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </button>
                                        <button class="btn-action btn-edit" title="Edit Patient">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </button>
                                        <button class="btn-action btn-delete" title="Delete Patient">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $paginator->links() }}
            </div>
        </div>
    </div>

    <style>
    .patient-list-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem;
    }

    .patient-list-header {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 2rem;
    }

    .page-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .btn-add-patient {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: #3b82f6;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .btn-add-patient:hover {
        background: #2563eb;
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .filter-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .filter-form {
        padding: 1.5rem 2rem;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .filter-input, .filter-select {
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background: white;
    }

    .filter-input:focus, .filter-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .filter-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .btn-filter, .btn-clear {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
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
        color: white;
        text-decoration: none;
    }

    .results-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .results-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    .results-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .results-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .results-count {
        font-size: 0.875rem;
        color: #6b7280;
        background: #e5e7eb;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
    }

    .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-wrapper {
        min-width: 100%;
        width: max-content;
    }

    .patient-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }

    .table-header {
        background: #f8fafc;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-row {
        border-bottom: 1px solid #f3f4f6;
        transition: all 0.2s ease;
    }

    .table-row:hover {
        background: #f9fafb;
    }

    .table-cell {
        padding: 1rem;
        vertical-align: middle;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }

    .patient-id {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    .id-label {
        font-size: 0.75rem;
        color: #6b7280;
        background: #f3f4f6;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-weight: 500;
    }

    .id-value {
        font-weight: 400;
        color: #1f2937;
    }

    .patient-name {
        display: flex;
        flex-direction: column;
        white-space: nowrap;
    }

    .name-primary {
        font-weight: 400;
        color: #1f2937;
    }

    .facility-info, .ssn-info {
        display: flex;
        flex-direction: column;
        white-space: nowrap;
    }

    .facility-name, .ssn-value {
        color: #374151;
        font-weight: 400;
    }

    .pcc-status {
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .status-badge {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 400;
    }

    .status-active {
        background: #dcfce7;
        color: #166534;
    }

    .status-inactive {
        background: #fee2e2;
        color: #dc2626;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        white-space: nowrap;
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

    .btn-view {
        background: #f3f4f6;
        color: #6b7280;
    }

    .btn-view:hover {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-edit {
        background: #dbeafe;
        color: #3b82f6;
    }

    .btn-edit:hover {
        background: #bfdbfe;
        color: #2563eb;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #fecaca;
        color: #b91c1c;
    }

    .pagination-container {
        padding: 1.5rem 2rem;
        border-top: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    @media (max-width: 768px) {
        .patient-list-container {
            padding: 1rem;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            justify-content: center;
        }

        .results-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }
    }
    </style>
    @endsection
</x-MainLayout>
