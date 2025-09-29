<x-MainLayout>
    <x-slot name="titlePage">
        List of Reports
    </x-slot>
    <x-slot name="activePage">
        reports
    </x-slot>
    @section('content')
    <div class="reports-container">
        <div class="reports-header">
            <h1 class="reports-title">Reports Dashboard</h1>
            <p class="reports-subtitle">Analytics and insights for your organization</p>
        </div>
        
        <div class="reports-iframe-container">
            <iframe
                src="https://reports.innovativemedsolution.com/public/dashboard/4efc1c50-f032-4a03-937b-60ca7a80adff"
                frameborder="0"
                allowtransparency
                class="reports-iframe">
            </iframe>
        </div>
    </div>
    
    <style>
    .reports-container {
        padding: 2rem;
        background: #f8fafc;
        min-height: 100vh;
    }
    
    .reports-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .reports-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 0.5rem 0;
    }
    
    .reports-subtitle {
        font-size: 1rem;
        color: #6b7280;
        margin: 0;
    }
    
    .reports-iframe-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    
    .reports-iframe {
        width: 100%;
        height: 800px;
        border: none;
        display: block;
    }
    
    @media (max-width: 768px) {
        .reports-container {
            padding: 1rem;
        }
        
        .reports-title {
            font-size: 1.5rem;
        }
        
        .reports-iframe {
            height: 600px;
        }
    }
    </style>
    @endsection
</x-MainLayout>