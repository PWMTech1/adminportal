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
                <div class="stat-value" id="lastMonthVisits">0</div>
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

            <canvas class="modern-chart" id="visitsChart" style="height: 400px; width: 100%;"></canvas>
            
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
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                    console.log('Chart updated successfully');
                } catch (error) {
                    console.error('Error loading chart data:', error);
                    // Use sample data as fallback
                    const sampleData = getSampleData(period);
                    chart.data = sampleData;
                    chart.update();
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
                if (!data || data.length === 0) return;
                
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
                
                // Update the card
                const lastMonthVisitsElement = document.getElementById('lastMonthVisits');
                if (lastMonthVisitsElement) {
                    lastMonthVisitsElement.textContent = lastMonthVisits;
                }
                
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
            }, 100); // 100ms delay to ensure DOM is ready
        });
    </script>
    @endsection

</x-MainLayout>