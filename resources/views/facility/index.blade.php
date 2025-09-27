<x-MainLayout>
    <x-slot name="titlePage">
        Facility Management
    </x-slot>
    <x-slot name="activePage">
        facility-management
    </x-slot>
    @section('content')
    <style>
        /* Modern Facility Table Styles */
        .facility-container {
            padding: 2rem;
            background: #f8fafc;
            min-height: 100vh;
        }
        
        .facility-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .facility-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }
        
        .facility-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .btn-add-facility {
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
        
        .btn-add-facility:hover {
            background: #2563eb;
            color: white;
            text-decoration: none;
        }
        
        .filter-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        
        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: end;
        }
        
        .filter-actions {
            grid-column: 1 / -1;
            justify-self: start;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .filter-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
        }
        
        .filter-input {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
            font-size: 0.875rem;
            color: #374151;
            min-width: 150px;
        }
        
        .filter-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .filter-select {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
            font-size: 0.875rem;
            color: #374151;
            min-width: 150px;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .filter-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            white-space: nowrap;
            flex-shrink: 0;
        }
        
        .btn-filter, .btn-clear {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-filter {
            background: #10b981;
            color: white;
        }
        
        .btn-filter:hover {
            background: #059669;
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
            overflow-x: auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        
        .table-header {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 1.5rem;
        }
        
        .table-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
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
        
        .facility-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .facility-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }
        
        .facility-address {
            font-size: 0.75rem;
            color: #6b7280;
            margin: 0;
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
        
        .loading-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            background: white;
        }
        
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        .loading-text {
            margin-left: 1rem;
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .pagination-container {
            display: flex;
            justify-content: center;
            padding: 2rem;
            background: white;
            border-top: 1px solid #e5e7eb;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }
        
        .empty-state h3 {
            margin: 0 0 0.5rem 0;
            font-size: 1.125rem;
            font-weight: 600;
        }
        
        .empty-state p {
            margin: 0;
            font-size: 0.875rem;
        }
        
        /* Pagination styling */
        .pagination {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 0.25rem;
        }
        
        .pagination li {
            display: flex;
        }
        
        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #374151;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            min-width: 40px;
            height: 40px;
        }
        
        .pagination a:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
            color: #1f2937;
        }
        
        .pagination .active span {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
            font-weight: 600;
        }
        
        .pagination .disabled span {
            background: #f9fafb;
            border-color: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
        }
    </style>

    <div class="facility-container">
        <!-- Header Section -->
        <div class="facility-header">
            <h1 class="facility-title">Facilities</h1>
            <div class="facility-actions">
                <a href="/facility/create" class="btn-add-facility">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Add Facility
                </a>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div class="filter-section">
            <form method="GET" action="/facility/list" id="filterForm">
                <div class="filter-form">
                    <div class="filter-group">
                        <label class="filter-label">Search Name</label>
                        <input type="text" class="filter-input" name="name" id="nameFilter" placeholder="Search by name...">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">City</label>
                        <input type="text" class="filter-input" name="city" id="cityFilter" placeholder="Search by city...">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">State</label>
                        <input type="text" class="filter-input" name="state" id="stateFilter" placeholder="Search by state...">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">PCC Status</label>
                        <select class="filter-select" name="pcc" id="pccFilter">
                            <option value="">All Facilities</option>
                            <option value="1">PCC Facilities</option>
                            <option value="0">Non-PCC Facilities</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="M21 21l-4.35-4.35"></path>
                            </svg>
                            Filter Results
                        </button>
                        <button type="button" class="btn-clear" onclick="clearFilters()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                </svg>
                            Clear Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Table Section -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">Facilities</h3>
            </div>
            
            <!-- Loading State -->
            <div id="tableLoading" class="loading-container">
                <div class="loading-spinner"></div>
                <div class="loading-text">Loading facilities...</div>
            </div>
            
            <!-- Table Content -->
            <div id="tableContent" style="display: none;">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Fax</th>
                            <th>PCC</th>
                            <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="facilitiesTableBody">
                        <!-- Facilities will be loaded here -->
                    </tbody>
                </table>
            </div>
            
            <!-- Empty State -->
            <div id="emptyState" class="empty-state" style="display: none;">
                <h3>No facilities found</h3>
                <p>Try adjusting your filter criteria or add a new facility.</p>
            </div>
        </div>
        
        <!-- Pagination -->
        <div id="paginationContainer" class="pagination-container" style="display: none;">
            <!-- Pagination will be loaded here -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Facility management page loaded');
            
            // Load facilities data
            loadFacilitiesData();
            
            // Handle filter form submission
            document.getElementById('filterForm').addEventListener('submit', function(e) {
                e.preventDefault();
                loadFacilitiesData();
            });
        });
        
        // Load facilities data asynchronously
        async function loadFacilitiesData(page = 1) {
            try {
                console.log('Loading facilities data for page:', page);
                
                // Show loading state
                document.getElementById('tableLoading').style.display = 'flex';
                document.getElementById('tableContent').style.display = 'none';
                document.getElementById('emptyState').style.display = 'none';
                document.getElementById('paginationContainer').style.display = 'none';
                
                // Get filter values
                const nameFilter = document.getElementById('nameFilter').value;
                const cityFilter = document.getElementById('cityFilter').value;
                const stateFilter = document.getElementById('stateFilter').value;
                const pccFilter = document.getElementById('pccFilter').value;
                
                // Build query parameters
                const params = new URLSearchParams();
                if (nameFilter) params.append('name', nameFilter);
                if (cityFilter) params.append('city', cityFilter);
                if (stateFilter) params.append('state', stateFilter);
                if (pccFilter) params.append('pcc', pccFilter);
                if (page && page > 1) params.append('page', page);
                
                // Fetch data
                const response = await fetch(`/facility/list?${params.toString()}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log('Facilities data received:', data);
                
                // Hide loading and show content
                document.getElementById('tableLoading').style.display = 'none';
                
                if (data.facilities && data.facilities.length > 0) {
                    document.getElementById('tableContent').style.display = 'block';
                    populateFacilitiesTable(data.facilities);
                    
                    // Always show pagination if we have facilities
                    document.getElementById('paginationContainer').style.display = 'flex';
                    if (data.pagination) {
                        populatePagination(data.pagination);
                    } else {
                        // Create basic pagination if not provided
                        createBasicPagination(data);
                    }
                } else {
                    document.getElementById('emptyState').style.display = 'block';
                }
                
            } catch (error) {
                console.error('Error loading facilities data:', error);
                
                // Hide loading and show error
                document.getElementById('tableLoading').style.display = 'none';
                document.getElementById('emptyState').style.display = 'block';
                document.getElementById('emptyState').innerHTML = `
                    <h3>Error loading facilities</h3>
                    <p>Please try refreshing the page.</p>
                `;
            }
        }
        
        // Populate facilities table
        function populateFacilitiesTable(facilities) {
            const tbody = document.getElementById('facilitiesTableBody');
            tbody.innerHTML = '';
            
            facilities.forEach(facility => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <div class="facility-info">
                            <h6 class="facility-name">${facility.Name}</h6>
                        </div>
                    </td>
                    <td>
                        <div class="facility-info">
                            <p class="facility-address">${facility.Address1 || 'N/A'}</p>
                            <p class="facility-address">${facility.City || ''}, ${facility.State || ''} ${facility.Zipcode5 || ''}</p>
                        </div>
                    </td>
                    <td>${facility.Phone || 'N/A'}</td>
                    <td>${facility.Fax || 'N/A'}</td>
                    <td>
                        ${facility.IsPCC ? 
                            '<svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" style="color: #10b981;"><polyline points="20 6 9 17 4 12"></polyline></svg>' : 
                            '<span style="color: #6b7280;">No</span>'
                        }
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/facility/edit/${facility.Id}" class="btn-action btn-edit" title="Edit Facility">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </a>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }
        
        // Populate pagination
        function populatePagination(pagination) {
            const container = document.getElementById('paginationContainer');
            container.innerHTML = pagination;
            
            // Add click event listeners to pagination links
            const paginationLinks = container.querySelectorAll('a[href*="page="]');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Extract page number from href
                    const url = new URL(this.href);
                    const page = url.searchParams.get('page');
                    
                    // Load data for the new page
                    loadFacilitiesData(page);
                });
            });
        }
        
        // Create basic pagination when not provided by backend
        function createBasicPagination(data) {
            const container = document.getElementById('paginationContainer');
            const currentPage = data.current_page || 1;
            const lastPage = data.last_page || 1;
            const total = data.total || 0;
            
            if (total <= 10) {
                // Hide pagination if only one page
                container.style.display = 'none';
                return;
            }
            
            let paginationHTML = '<ul class="pagination">';
            
            // Previous button
            if (currentPage > 1) {
                paginationHTML += `<li><a href="#" data-page="${currentPage - 1}">« Previous</a></li>`;
            } else {
                paginationHTML += '<li class="disabled"><span>« Previous</span></li>';
            }
            
            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(lastPage, currentPage + 2);
            
            if (startPage > 1) {
                paginationHTML += `<li><a href="#" data-page="1">1</a></li>`;
                if (startPage > 2) {
                    paginationHTML += '<li class="disabled"><span>...</span></li>';
                }
            }
            
            for (let i = startPage; i <= endPage; i++) {
                if (i === currentPage) {
                    paginationHTML += `<li class="active"><span>${i}</span></li>`;
                } else {
                    paginationHTML += `<li><a href="#" data-page="${i}">${i}</a></li>`;
                }
            }
            
            if (endPage < lastPage) {
                if (endPage < lastPage - 1) {
                    paginationHTML += '<li class="disabled"><span>...</span></li>';
                }
                paginationHTML += `<li><a href="#" data-page="${lastPage}">${lastPage}</a></li>`;
            }
            
            // Next button
            if (currentPage < lastPage) {
                paginationHTML += `<li><a href="#" data-page="${currentPage + 1}">Next »</a></li>`;
            } else {
                paginationHTML += '<li class="disabled"><span>Next »</span></li>';
            }
            
            paginationHTML += '</ul>';
            container.innerHTML = paginationHTML;
            
            // Add click event listeners
            const paginationLinks = container.querySelectorAll('a[data-page]');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const page = this.getAttribute('data-page');
                    loadFacilitiesData(page);
                });
            });
        }
        
        // Clear all filters function
        function clearFilters() {
            document.getElementById('nameFilter').value = '';
            document.getElementById('cityFilter').value = '';
            document.getElementById('stateFilter').value = '';
            document.getElementById('pccFilter').value = '';
            
            // Reload data with cleared filters (reset to page 1)
            loadFacilitiesData(1);
        }
    </script>
    @endsection
</x-MainLayout>
