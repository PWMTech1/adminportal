<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('PinnacleWoundCare - Admin Panel') }}</title>
    <script src="https://cdn.tailwindcss.com/"></script>
    <script src="/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
    <style>
    body {
        font-family: 'Maven Pro' !important;
        margin: 0;
        padding: 0;
    }

    .ui-widget {
        font-family: 'Maven Pro' !important;
    }

    .ui-datepicker {
        padding: 0 !important;
    }
    
    /* Layout fixes for fixed sidebar */
    .main-content {
        margin-left: 280px;
        min-height: 100vh;
        background: #f8fafc;
        transition: margin-left 0.3s ease;
    }
    
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
        }
    }
    </style>
</head>

<body class="">
    <div class="min-h-full">
        @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @include('layouts.navbars.sidebar-new')
        @endauth
        
        @guest()
        @include('layouts.page_templates.guest')
        @endguest

        @auth()
        <div class="main-content">
            <div class="p-6">
                @yield('content')
            </div>
        </div>
        @endauth
    </div>
    @livewireScripts()
</body>

</html>