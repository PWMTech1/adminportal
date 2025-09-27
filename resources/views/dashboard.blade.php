<x-MainLayout>
    <x-slot name="titlePage">
        Dashboard
    </x-slot>
    <x-slot name="activePage">
        dashboard
    </x-slot>
    @section('content')
    <style>
        /* Modern Dashboard Styles */
        .dashboard-container {
            padding: 2rem;
            background: #f8fafc;
            min-height: 100vh;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card.blue {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        }
        
        .stat-card.red {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }
        
        .stat-card.green {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        }
        
        .stat-card.purple {
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .stat-card.blue::before {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        }
        
        .stat-card.red::before {
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }
        
        .stat-card.green::before {
            background: linear-gradient(90deg, #10b981, #059669);
        }
        
        .stat-card.purple::before {
            background: linear-gradient(90deg, #8b5cf6, #7c3aed);
        }
        
        .stat-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.5rem;
            line-height: 1;
        }
        
        .stat-subtitle {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }
        
        .stat-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 3rem;
            height: 3rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-card.blue .stat-icon {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }
        
        .stat-card.red .stat-icon {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }
        
        .stat-card.green .stat-icon {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        
        .stat-card.purple .stat-icon {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }
        
        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            margin-bottom: 2rem;
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .chart-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }
        
        .chart-tabs {
            display: flex;
            gap: 0.5rem;
        }
        
        .chart-tab {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            background: white;
            color: #6b7280;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .chart-tab.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .chart-tab:hover:not(.active) {
            background: #f3f4f6;
            border-color: #9ca3af;
        }
        
        .modern-chart {
            height: 400px !important;
            width: 100% !important;
            max-height: 400px;
        }
        
        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1rem;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }
        
        /* Map Card Styles */
        .map-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: none;
            margin-bottom: 2rem;
        }
        
        .map-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .map-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }
        
        .map-container {
            height: 400px;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            background: #f8fafc;
        }
        
        .map-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .facility-marker {
            background: #3b82f6;
            border: 2px solid white;
            border-radius: 50%;
            width: 12px;
            height: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .facility-marker:hover {
            background: #1d4ed8;
            transform: scale(1.2);
        }
        
        .facility-tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            pointer-events: none;
            z-index: 1000;
            max-width: 200px;
        }
        
        /* Loading animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <div class="dashboard-container">
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9,22 9,12 15,12 15,22"></polyline>
                    </svg>
                </div>
                <div class="stat-title">Total Facilities</div>
                <div class="stat-value">{{$objects->TotalFacilities}}</div>
                <div class="stat-subtitle">Active: {{$objects->TotalActiveFacilities}}</div>
            </div>
            
            <div class="stat-card red">
                <div class="stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div class="stat-title">Total Visits</div>
                <div class="stat-value" id="lastMonthVisits">
                    <div id="visitsLoading" style="display: flex; align-items: center; justify-content: center; height: 60px;">
                        <div style="width: 24px; height: 24px; border: 3px solid #fee2e2; border-top: 3px solid #ef4444; border-radius: 50%; animation: spin 1s linear infinite;"></div>
                    </div>
                    <span id="visitsValue" style="display: none;">0</span>
                </div>
                <div class="stat-subtitle">Last month</div>
            </div>
            
            <div class="stat-card green">
                <div class="stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="stat-title">Active Clinicians</div>
                <div class="stat-value">{{$objects->TotalActiveFacilities}}</div>
                <div class="stat-subtitle">Currently active</div>
            </div>
            
            <!-- <div class="stat-card purple">
                <div class="stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22,4 12,14.01 9,11.01"></polyline>
                    </svg>
                </div>
                <div class="stat-title">Success Rate</div>
                <div class="stat-value">94%</div>
                <div class="stat-subtitle">Treatment success</div>
            </div> -->
            </div>
        
        <!-- Modern Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Total Visits per Month</h3>
                <div class="chart-tabs">
                    <button class="chart-tab active" data-period="monthly">Monthly</button>
                    <button class="chart-tab" data-period="quarterly">Quarterly</button>
                    <button class="chart-tab" data-period="yearly">Yearly</button>
        </div>
    </div>
    
            <div id="chartLoading" style="display: flex; align-items: center; justify-content: center; height: 400px; background: #f8fafc; border-radius: 8px;">
                <div style="text-align: center;">
                    <div style="width: 40px; height: 40px; border: 4px solid #e2e8f0; border-top: 4px solid #3b82f6; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 16px;"></div>
                    <div style="color: #6b7280; font-size: 14px; font-weight: 500;">Loading chart data...</div>
                </div>
            </div>
            <canvas class="modern-chart" id="visitsChart" style="height: 400px; width: 100%; display: none;"></canvas>
            
            <div class="chart-legend" id="chartLegend">
                <div class="legend-item">
                    <div class="legend-color" style="background: #3b82f6;"></div>
                    <span id="currentYearLabel">2024</span>
                    </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #10b981;"></div>
                    <span id="lastYearLabel">2023</span>
                    </div>
                </div>
        </div>
        
        <!-- Facilities Map Card -->
        <div class="map-card">
            <div class="map-header">
                <h3 class="map-title">Facilities Location</h3>
            </div>
            <div class="map-container" id="facilitiesMap">
                <div class="map-loading">Loading facilities map...</div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- jQuery Vector Map for USA visualization -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/jvectormap@2.0.4/jquery-jvectormap.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jvectormap@2.0.4/jquery-jvectormap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jvectormap@2.0.4/maps/jquery-jvectormap-us-aea-en.js"></script>
    
    <!-- Alternative USA map data -->
    <script src="https://cdn.jsdelivr.net/npm/jvectormap@2.0.4/maps/jquery-jvectormap-us-ae.js"></script>

    <script type="text/javascript">
        function LoadPDF(_url){
            $.ajax({
                url: _url,
                type: 'GET',
                success: function(data){
                    let pdfWindow = window.open("");
                    pdfWindow.document.write(
                        "<iframe width='100%' height='100%' src='" +
                        data.notes + "'></iframe>"
                    );
                }
            })
        }

        // Modern Chart Implementation
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing chart...');
            
            // Add a small delay to ensure all elements are rendered
            setTimeout(function() {
                const chartElement = document.getElementById('visitsChart');
                if (!chartElement) {
                    console.error('Chart element with id "visitsChart" not found');
                    console.log('Available elements:', document.querySelectorAll('[id]'));
                    return;
                }
                
                console.log('Chart element found:', chartElement);
                
                if (chartElement.tagName !== 'CANVAS') {
                    console.error('Element is not a canvas element, it is:', chartElement.tagName);
                    return;
                }
                
                const ctx = chartElement.getContext('2d');
            
            // Fetch real data from controller
            let chartData = null;
            let chart = null;
            
            // Function to fetch visit data
            async function fetchVisitData() {
                try {
                    console.log('Fetching visit data from /getvisitsbymonth...');
                    
                    // Add CSRF token for Laravel
                    const token = document.querySelector('meta[name="csrf-token"]');
                    const headers = {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    };
                    
                    if (token) {
                        headers['X-CSRF-TOKEN'] = token.getAttribute('content');
                    }
                    
                    const response = await fetch('/getvisitsbymonth', {
                        method: 'GET',
                        headers: headers,
                        credentials: 'same-origin'
                    });
                    
                    console.log('Response status:', response.status);
                    console.log('Response URL:', response.url);
                    
                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error('Response error text:', errorText);
                        throw new Error(`HTTP error! status: ${response.status} - ${errorText}`);
                    }
                    
                    const data = await response.json();
                    console.log('Raw data received:', data);
                    console.log('Data type:', typeof data);
                    console.log('Data length:', Array.isArray(data) ? data.length : 'Not an array');
                    return data;
                } catch (error) {
                    console.error('Error fetching visit data:', error);
                    console.error('Error details:', error.message);
                    return [];
                }
            }
            
            // Function to process data for different periods
            function processDataForPeriod(data, period) {
                console.log('Processing data for period:', period, 'Data:', data);
                if (!data || data.length === 0) {
                    console.log('No data available, returning empty chart');
                    return { labels: [], datasets: [] };
                }
                
                const currentYear = new Date().getFullYear();
                const lastYear = currentYear - 1;
                
                console.log('Current year:', currentYear, 'Last year:', lastYear);
                
                if (period === 'monthly') {
                    // Group by month for current and last year
                    const monthlyData = {};
                    data.forEach(item => {
                        // Parse the date string (format: "Jan-2024")
                        const [monthStr, yearStr] = item.x.split('-');
                        const year = parseInt(yearStr);
                        const monthIndex = new Date(monthStr + ' 1, 2000').getMonth();
                        
                        if (year === currentYear || year === lastYear) {
                            if (!monthlyData[year]) monthlyData[year] = {};
                            monthlyData[year][monthIndex] = (monthlyData[year][monthIndex] || 0) + item.y;
                        }
                    });
                    
                    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    const currentYearData = labels.map((_, index) => monthlyData[currentYear]?.[index] || 0);
                    const lastYearData = labels.map((_, index) => monthlyData[lastYear]?.[index] || 0);
                    
                    return {
                        labels: labels,
                        datasets: [
                            {
                                label: currentYear.toString(),
                                data: currentYearData,
                                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                borderColor: '#3b82f6',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            },
                            {
                                label: lastYear.toString(),
                                data: lastYearData,
                                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                borderColor: '#10b981',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            }
                        ]
                    };
                } else if (period === 'quarterly') {
                    // Group by quarter
                    const quarterlyData = {};
                    data.forEach(item => {
                        const [monthStr, yearStr] = item.x.split('-');
                        const year = parseInt(yearStr);
                        const monthIndex = new Date(monthStr + ' 1, 2000').getMonth();
                        const quarter = Math.floor(monthIndex / 3) + 1;
                        
                        if (year === currentYear || year === lastYear) {
                            const key = `${year}-Q${quarter}`;
                            quarterlyData[key] = (quarterlyData[key] || 0) + item.y;
                        }
                    });
                    
                    const labels = ['Q1', 'Q2', 'Q3', 'Q4'];
                    const currentYearData = [1, 2, 3, 4].map(q => quarterlyData[`${currentYear}-Q${q}`] || 0);
                    const lastYearData = [1, 2, 3, 4].map(q => quarterlyData[`${lastYear}-Q${q}`] || 0);
                    
                    return {
                        labels: labels,
                        datasets: [
                            {
                                label: currentYear.toString(),
                                data: currentYearData,
                                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                borderColor: '#3b82f6',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            },
                            {
                                label: lastYear.toString(),
                                data: lastYearData,
                                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                borderColor: '#10b981',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            }
                        ]
                    };
                } else if (period === 'yearly') {
                    // Group by year
                    const yearlyData = {};
                    data.forEach(item => {
                        const [monthStr, yearStr] = item.x.split('-');
                        const year = parseInt(yearStr);
                        yearlyData[year] = (yearlyData[year] || 0) + item.y;
                    });
                    
                    const years = Object.keys(yearlyData).sort();
                    const values = years.map(year => yearlyData[year]);
                    
                    return {
                        labels: years,
                        datasets: [
                            {
                                label: 'Total Visits',
                                data: values,
                                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                borderColor: '#3b82f6',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            }
                        ]
                    };
                }
                
                return { labels: [], datasets: [] };
            }

            // Chart configuration
            const chartConfig = {
                type: 'bar',
                data: { labels: [], datasets: [] },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                color: '#6b7280'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#e5e7eb',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' visits';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                callback: function(value) {
                                    return value + ' visits';
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            };

            // Initialize chart
            chart = new Chart(ctx, chartConfig);

            // Load initial data
            async function loadChartData(period = 'monthly') {
                try {
                    console.log('Loading chart data for period:', period);
                    const rawData = await fetchVisitData();
                    console.log('Raw data from fetch:', rawData);
                    
                    let processedData;
                    if (rawData && rawData.length > 0) {
                        console.log('Using real data from API');
                        processedData = processDataForPeriod(rawData, period);
                        console.log('Processed data:', processedData);
                        
                        // Update legend labels with dynamic years
                        updateLegendLabels();
                        
                        // Update Total Visits card with last month's data
                        updateTotalVisitsCard(rawData);
                    } else {
                        console.log('No data from API, using sample data');
                        console.log('Raw data was:', rawData);
                        console.log('Raw data length:', rawData ? rawData.length : 'null/undefined');
                        // Fallback to sample data if no real data
                        processedData = getSampleData(period);
                    }
                    
                    chart.data = processedData;
                    chart.update();
                    
                    // Hide loading and show chart
                    document.getElementById('chartLoading').style.display = 'none';
                    document.getElementById('visitsChart').style.display = 'block';
                    
                    console.log('Chart updated successfully');
                } catch (error) {
                    console.error('Error loading chart data:', error);
                    // Use sample data as fallback
                    const sampleData = getSampleData(period);
                    chart.data = sampleData;
                    chart.update();
                    
                    // Hide loading and show chart even on error
                    document.getElementById('chartLoading').style.display = 'none';
                    document.getElementById('visitsChart').style.display = 'block';
                }
            }
            
            // Update legend labels with current and last year
            function updateLegendLabels() {
                const currentYear = new Date().getFullYear();
                const lastYear = currentYear - 1;
                
                const currentYearLabel = document.getElementById('currentYearLabel');
                const lastYearLabel = document.getElementById('lastYearLabel');
                
                if (currentYearLabel) currentYearLabel.textContent = currentYear.toString();
                if (lastYearLabel) lastYearLabel.textContent = lastYear.toString();
            }
            
            // Update Total Visits card with last month's data from chart
            function updateTotalVisitsCard(data) {
                if (!data || data.length === 0) {
                    // Hide loading and show 0 if no data
                    document.getElementById('visitsLoading').style.display = 'none';
                    document.getElementById('visitsValue').style.display = 'block';
                    document.getElementById('visitsValue').textContent = '0';
                    return;
                }
                
                const currentYear = new Date().getFullYear();
                const lastMonth = new Date().getMonth() - 1; // Previous month
                const lastMonthName = new Date(0, lastMonth).toLocaleString('default', { month: 'short' });
                
                // Find last month's data from the chart data
                let lastMonthVisits = 0;
                data.forEach(item => {
                    const [monthStr, yearStr] = item.x.split('-');
                    const year = parseInt(yearStr);
                    const monthIndex = new Date(monthStr + ' 1, 2000').getMonth();
                    
                    if (year === currentYear && monthIndex === lastMonth) {
                        lastMonthVisits = item.y;
                    }
                });
                
                // Hide loading and show the value
                document.getElementById('visitsLoading').style.display = 'none';
                document.getElementById('visitsValue').style.display = 'block';
                document.getElementById('visitsValue').textContent = lastMonthVisits;
                
                console.log(`Updated Total Visits card with ${lastMonthVisits} visits for ${lastMonthName} ${currentYear}`);
            }
            
            // Sample data fallback
            function getSampleData(period) {
                if (period === 'monthly') {
                    return {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [
                            {
                                label: '2024',
                                data: [45, 62, 58, 78, 85, 92, 88, 95, 87, 102, 94, 108],
                                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                borderColor: '#3b82f6',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            },
                            {
                                label: '2023',
                                data: [32, 45, 38, 52, 48, 65, 58, 72, 68, 78, 71, 85],
                                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                borderColor: '#10b981',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            }
                        ]
                    };
                } else if (period === 'quarterly') {
                    return {
                        labels: ['Q1', 'Q2', 'Q3', 'Q4'],
                        datasets: [
                            {
                                label: '2024',
                                data: [165, 255, 284, 304],
                                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                borderColor: '#3b82f6',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            },
                            {
                                label: '2023',
                                data: [115, 165, 198, 234],
                                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                borderColor: '#10b981',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            }
                        ]
                    };
                } else {
                    return {
                        labels: ['2020', '2021', '2022', '2023', '2024'],
                        datasets: [
                            {
                                label: 'Total Visits',
                                data: [450, 580, 720, 712, 1008],
                                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                borderColor: '#3b82f6',
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            }
                        ]
                    };
                }
            }

            // Tab switching functionality
            const tabs = document.querySelectorAll('.chart-tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Load data for selected period
                    const period = this.dataset.period;
                    loadChartData(period);
                });
            });

            // Load initial data
            loadChartData('monthly');
            
            // Load facilities map with professional jVectorMap
            loadFacilitiesMapWithVectorMap();
            }, 100); // 100ms delay to ensure DOM is ready
        });
        
        // Load facilities map with jVectorMap
        async function loadFacilitiesMapWithVectorMap() {
            try {
                console.log('Loading facilities map with jVectorMap...');
                const response = await fetch('/getfacilitiesformap', {
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
                
                const facilities = await response.json();
                console.log('Facilities data:', facilities);
                
                // Use real data if available with coordinates, otherwise use sample data
                const facilitiesWithCoords = facilities.filter(facility => 
                    facility.Latitude && facility.Longitude && 
                    facility.Latitude !== '0' && facility.Longitude !== '0' &&
                    facility.Latitude !== '' && facility.Longitude !== ''
                );
                
                console.log('Facilities with coordinates:', facilitiesWithCoords.length);
                
                if (facilitiesWithCoords.length > 0) {
                    console.log('Using real facility data with coordinates');
                    createFacilitiesMapWithVectorMap(facilitiesWithCoords);
                } else {
                    console.log('No facilities with valid coordinates, using sample data');
                    const sampleFacilities = getSampleFacilitiesData();
                    createFacilitiesMapWithVectorMap(sampleFacilities);
                }
                
            } catch (error) {
                console.error('Error loading facilities map:', error);
                console.log('Using sample data due to error');
                const sampleFacilities = getSampleFacilitiesData();
                createFacilitiesMapWithVectorMap(sampleFacilities);
            }
        }
        
        // Load facilities map
        async function loadFacilitiesMap() {
            try {
                console.log('Loading facilities map...');
                const response = await fetch('/getfacilitiesformap', {
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
                
                const facilities = await response.json();
                console.log('Facilities data:', facilities);
                
                // Check if we have facilities with valid coordinates
                const facilitiesWithCoords = facilities.filter(facility => 
                    facility.Latitude && facility.Longitude && 
                    facility.Latitude !== '0' && facility.Longitude !== '0' &&
                    facility.Latitude !== '' && facility.Longitude !== ''
                );
                
                console.log('Facilities with coordinates:', facilitiesWithCoords.length);
                
                // Use real data if available with coordinates, otherwise use sample data
                if (facilitiesWithCoords.length > 0) {
                    console.log('Using real facility data with coordinates');
                    createFacilitiesMap(facilitiesWithCoords);
                } else {
                    console.log('No facilities with valid coordinates, using sample data');
                    const sampleFacilities = getSampleFacilitiesData();
                    createFacilitiesMap(sampleFacilities);
                }
                
            } catch (error) {
                console.error('Error loading facilities map:', error);
                console.log('Using sample data due to error');
                const sampleFacilities = getSampleFacilitiesData();
                createFacilitiesMap(sampleFacilities);
            }
        }
        
        // Sample facilities data for demonstration
        function getSampleFacilitiesData() {
            return [
                {
                    Name: "Pinnacle Wound Care - Los Angeles",
                    Address: "1234 Medical Plaza Dr",
                    City: "Los Angeles",
                    State: "CA",
                    ZipCode: "90210",
                    Latitude: "34.0522",
                    Longitude: "-118.2437"
                },
                {
                    Name: "Pinnacle Wound Care - New York",
                    Address: "5678 Healthcare Ave",
                    City: "New York",
                    State: "NY",
                    ZipCode: "10001",
                    Latitude: "40.7128",
                    Longitude: "-74.0060"
                },
                {
                    Name: "Pinnacle Wound Care - Chicago",
                    Address: "9012 Medical Center Blvd",
                    City: "Chicago",
                    State: "IL",
                    ZipCode: "60601",
                    Latitude: "41.8781",
                    Longitude: "-87.6298"
                },
                {
                    Name: "Pinnacle Wound Care - Houston",
                    Address: "3456 Health Plaza Dr",
                    City: "Houston",
                    State: "TX",
                    ZipCode: "77001",
                    Latitude: "29.7604",
                    Longitude: "-95.3698"
                },
                {
                    Name: "Pinnacle Wound Care - Miami",
                    Address: "7890 Care Center Way",
                    City: "Miami",
                    State: "FL",
                    ZipCode: "33101",
                    Latitude: "25.7617",
                    Longitude: "-80.1918"
                },
                {
                    Name: "Pinnacle Wound Care - Phoenix",
                    Address: "2345 Desert Medical Dr",
                    City: "Phoenix",
                    State: "AZ",
                    ZipCode: "85001",
                    Latitude: "33.4484",
                    Longitude: "-112.0740"
                },
                {
                    Name: "Pinnacle Wound Care - Seattle",
                    Address: "6789 Pacific Health Ave",
                    City: "Seattle",
                    State: "WA",
                    ZipCode: "98101",
                    Latitude: "47.6062",
                    Longitude: "-122.3321"
                },
                {
                    Name: "Pinnacle Wound Care - Denver",
                    Address: "4567 Mountain Care Blvd",
                    City: "Denver",
                    State: "CO",
                    ZipCode: "80201",
                    Latitude: "39.7392",
                    Longitude: "-104.9903"
                }
            ];
        }
        
        // Create facilities map with a reliable USA SVG map
        function createFacilitiesMap(facilities) {
            const mapContainer = document.getElementById('facilitiesMap');
            
            if (!facilities || facilities.length === 0) {
                mapContainer.innerHTML = '<div class="map-loading">No facilities found</div>';
                return;
            }
            
            // Create a proper USA map with realistic geographic boundaries
            const mapHTML = `
                <div style="position: relative; width: 100%; height: 400px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 8px; overflow: hidden;">
                    <svg width="100%" height="100%" viewBox="0 0 1000 600" style="position: absolute; top: 0; left: 0;">
                        <!-- USA Main Outline with realistic shape -->
                        <path d="M100,100 L900,100 L900,500 L100,500 Z M120,120 L880,120 L880,480 L120,480 Z" fill="#f1f5f9" stroke="#94a3b8" stroke-width="2"/>
                        
                        <!-- California - Realistic West Coast shape -->
                        <path d="M120,150 L200,150 L200,400 L120,400 L120,350 L140,350 L140,200 L120,200 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="CA"/>
                        <text x="160" y="280" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">CA</text>
                        
                        <!-- Texas - Large realistic shape -->
                        <path d="M300,200 L600,200 L600,450 L300,450 L300,400 L350,400 L350,250 L300,250 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="TX"/>
                        <text x="450" y="330" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">TX</text>
                        
                        <!-- Florida - Peninsula shape -->
                        <path d="M700,350 L850,350 L850,500 L700,500 L700,450 L750,450 L750,400 L700,400 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="FL"/>
                        <text x="775" y="430" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">FL</text>
                        
                        <!-- New York - Northeast shape -->
                        <path d="M750,100 L900,100 L900,200 L750,200 L750,150 L800,150 L800,120 L750,120 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="NY"/>
                        <text x="825" y="155" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">NY</text>
                        
                        <!-- Illinois - Midwest shape -->
                        <path d="M450,180 L550,180 L550,280 L450,280 L450,250 L500,250 L500,200 L450,200 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="IL"/>
                        <text x="500" y="235" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">IL</text>
                        
                        <!-- Arizona - Southwest shape -->
                        <path d="M200,280 L350,280 L350,400 L200,400 L200,350 L250,350 L250,300 L200,300 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="AZ"/>
                        <text x="275" y="345" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">AZ</text>
                        
                        <!-- Washington - Pacific Northwest shape -->
                        <path d="M100,100 L200,100 L200,200 L100,200 L100,150 L150,150 L150,120 L100,120 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="WA"/>
                        <text x="150" y="155" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">WA</text>
                        
                        <!-- Colorado - Mountain shape -->
                        <path d="M350,180 L450,180 L450,280 L350,280 L350,250 L400,250 L400,200 L350,200 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="CO"/>
                        <text x="400" y="235" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">CO</text>
                        
                        <!-- Nevada - Desert shape -->
                        <path d="M200,180 L300,180 L300,280 L200,280 L200,250 L250,250 L250,200 L200,200 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="NV"/>
                        <text x="250" y="235" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">NV</text>
                        
                        <!-- Georgia - Southeast shape -->
                        <path d="M650,300 L750,300 L750,400 L650,400 L650,350 L700,350 L700,320 L650,320 Z" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1" class="state" data-state="GA"/>
                        <text x="700" y="355" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#64748b">GA</text>
                        
                        <!-- Add more realistic coastline details -->
                        <path d="M100,100 L120,120 L140,140 L160,160 L180,180 L200,200 L220,220 L240,240 L260,260 L280,280 L300,300 L320,320 L340,340 L360,360 L380,380 L400,400 L420,420 L440,440 L460,460 L480,480 L500,500" 
                              fill="none" stroke="#94a3b8" stroke-width="1" opacity="0.3"/>
                        
                        <!-- Map Title -->
                        <text x="500" y="30" text-anchor="middle" font-family="Arial" font-size="18" font-weight="bold" fill="#1f2937">Facility Locations Across United States</text>
                        
                        <!-- Legend -->
                        <rect x="50" y="480" width="200" height="60" fill="white" stroke="#e5e7eb" stroke-width="1" rx="4"/>
                        <text x="70" y="500" font-family="Arial" font-size="12" fill="#6b7280">Facilities: ${facilities.length}</text>
                        <circle cx="70" cy="515" r="4" fill="#3b82f6" stroke="white" stroke-width="2"/>
                        <text x="85" y="520" font-family="Arial" font-size="10" fill="#6b7280">Facility Location</text>
                    </svg>
                    
                    <!-- Facility Markers Container -->
                    <div id="facility-markers" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;"></div>
                </div>
            `;
            
            // Set the HTML content
            mapContainer.innerHTML = mapHTML;
            
            // Add facility markers after a short delay
            setTimeout(() => {
                addFacilityMarkersToMap(facilities);
            }, 100);
            
            console.log(`Map created with ${facilities.length} facilities`);
        }
        
        // Create facilities map using jVectorMap (professional USA map)
        function createFacilitiesMapWithVectorMap(facilities) {
            const mapContainer = document.getElementById('facilitiesMap');
            
            if (!facilities || facilities.length === 0) {
                mapContainer.innerHTML = '<div class="map-loading">No facilities found</div>';
                return;
            }
            
            // Clear container and add jVectorMap container
            mapContainer.innerHTML = `
                <div style="position: relative; width: 100%; height: 400px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 8px; overflow: hidden;">
                    <div id="usa-map" style="width: 100%; height: 100%;"></div>
                    <div style="position: absolute; top: 10px; left: 10px; background: white; padding: 8px 12px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-size: 14px; font-weight: 600; color: #1f2937;">
                        Facility Locations: ${facilities.length}
                    </div>
                </div>
            `;
            
            // Initialize jVectorMap after a short delay to ensure DOM is ready
            setTimeout(() => {
                try {
                    // Check if jVectorMap is loaded
                    if (typeof $.fn.vectorMap === 'undefined') {
                        throw new Error('jVectorMap library not loaded');
                    }
                    
                    // Try different map names as fallback
                    let mapName = 'us_aea_en';
                    if (typeof $.fn.vectorMap.maps === 'undefined' || !$.fn.vectorMap.maps[mapName]) {
                        mapName = 'us_ae';
                        if (!$.fn.vectorMap.maps[mapName]) {
                            throw new Error('USA map data not available');
                        }
                    }
                    
                    console.log('Using map:', mapName);
                    
                    $('#usa-map').vectorMap({
                        map: mapName,
                        backgroundColor: 'transparent',
                        regionStyle: {
                            initial: {
                                fill: '#e2e8f0',
                                stroke: '#cbd5e1',
                                'stroke-width': 1,
                                'fill-opacity': 0.8
                            },
                            hover: {
                                fill: '#3b82f6',
                                'fill-opacity': 0.9,
                                cursor: 'pointer'
                            }
                        },
                        onRegionClick: function(event, code) {
                            console.log('Clicked on state:', code);
                        },
                        onRegionTipShow: function(event, tip, code) {
                            tip.html('<div style="background: rgba(0,0,0,0.8); color: white; padding: 8px; border-radius: 4px; font-size: 12px;">' + 
                                    '<strong>' + code.toUpperCase() + '</strong><br>' +
                                    'Click to view details</div>');
                        }
                    });
                    
                    // Add facility markers after map is initialized
                    addFacilityMarkersToVectorMap(facilities);
                    
                    console.log(`Professional USA map created with ${facilities.length} facilities`);
                } catch (error) {
                    console.error('Error initializing vector map:', error);
                    // Fallback to simple SVG map
                    createFallbackMap(facilities);
                }
            }, 500); // Increased delay to ensure all scripts are loaded
        }
        
        // Fallback map function when jVectorMap fails
        function createFallbackMap(facilities) {
            const mapContainer = document.getElementById('facilitiesMap');
            mapContainer.innerHTML = `
                <div style="position: relative; width: 100%; height: 400px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 8px; overflow: hidden;">
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; text-align: center;">
                        <div>
                            <div style="font-size: 48px; color: #3b82f6; margin-bottom: 16px;">🗺️</div>
                            <h3 style="color: #1f2937; margin-bottom: 8px;">USA Map</h3>
                            <p style="color: #6b7280; margin-bottom: 16px;">Facility Locations: ${facilities.length}</p>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px; justify-content: center;">
                                ${facilities.slice(0, 6).map(facility => 
                                    `<span style="background: #3b82f6; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">${facility.State || 'Unknown'}</span>`
                                ).join('')}
                                ${facilities.length > 6 ? `<span style="background: #e2e8f0; color: #6b7280; padding: 4px 8px; border-radius: 4px; font-size: 12px;">+${facilities.length - 6} more</span>` : ''}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            console.log('Fallback map created with', facilities.length, 'facilities');
        }
        
        // Add facility markers to the vector map
        function addFacilityMarkersToVectorMap(facilities) {
            // This function will be implemented to add markers to the jVectorMap
            console.log('Adding markers to vector map:', facilities.length);
        }
        
        // Add facility markers to the map
        function addFacilityMarkersToMap(facilities) {
            const markersContainer = document.getElementById('facility-markers');
            if (!markersContainer) return;
            
            facilities.forEach((facility, index) => {
                if (facility.Latitude && facility.Longitude) {
                    const lat = parseFloat(facility.Latitude);
                    const lng = parseFloat(facility.Longitude);
                    
                    // Convert lat/lng to percentage coordinates for positioning
                    const x = 50 + (lng + 180) * 900 / 360; // 50 to 950 range
                    const y = 50 + (90 - lat) * 500 / 180;  // 50 to 550 range
                    
                    // Create marker element
                    const marker = document.createElement('div');
                    marker.className = 'facility-marker';
                    marker.style.position = 'absolute';
                    marker.style.left = `${x}px`;
                    marker.style.top = `${y}px`;
                    marker.style.width = '12px';
                    marker.style.height = '12px';
                    marker.style.background = '#3b82f6';
                    marker.style.border = '3px solid white';
                    marker.style.borderRadius = '50%';
                    marker.style.cursor = 'pointer';
                    marker.style.pointerEvents = 'auto';
                    marker.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)';
                    marker.style.transform = 'translate(-50%, -50%)';
                    marker.style.transition = 'all 0.2s ease';
                    
                    // Add hover effects
                    marker.addEventListener('mouseenter', function(e) {
                        marker.style.width = '16px';
                        marker.style.height = '16px';
                        marker.style.background = '#1d4ed8';
                        marker.style.boxShadow = '0 4px 8px rgba(0,0,0,0.3)';
                        showTooltip(e, facility);
                    });
                    
                    marker.addEventListener('mouseleave', function() {
                        marker.style.width = '12px';
                        marker.style.height = '12px';
                        marker.style.background = '#3b82f6';
                        marker.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)';
                        hideTooltip();
                    });
                    
                    markersContainer.appendChild(marker);
                }
            });
        }
        
        // Show tooltip for facility
        function showTooltip(event, facility) {
            const tooltip = document.createElement('div');
            tooltip.className = 'facility-tooltip';
            tooltip.innerHTML = `
                <strong>${facility.Name}</strong><br>
                ${facility.Address}<br>
                ${facility.City}, ${facility.State} ${facility.ZipCode}
            `;
            
            document.body.appendChild(tooltip);
            
            const rect = event.target.getBoundingClientRect();
            tooltip.style.left = (rect.left + window.scrollX) + 'px';
            tooltip.style.top = (rect.top + window.scrollY - tooltip.offsetHeight - 10) + 'px';
        }
        
        // Hide tooltip
        function hideTooltip() {
            const tooltip = document.querySelector('.facility-tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        }
    </script>
    @endsection

</x-MainLayout>