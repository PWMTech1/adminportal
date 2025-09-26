<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('PinnacleWoundCare - Admin Panel') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dash_1.css" rel="stylesheet">
    <link href="/css/dash_2.css" rel="stylesheet">
    <link href="/css/structure.css" rel="stylesheet">
    <link href="/css/apexcharts.css" rel="stylesheet">
    <link href="/css/custom-pagination.css" rel="stylesheet">
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
    
    </head>
    <body class="{{ $class ?? '' }}">
        <div class="header-container fixed-top">
            <header class="header navbar navbar-expand-sm">
                <ul class="navbar-item theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        InnovativeMedSolution
                    </li>
                    <li class="nav-item theme-text">
                        <a class="nav-link">{{$titlePage}}</a>
                    </li>
                </ul>
            </header>
        </div>
        <div class="main-container" id="container">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.page_templates.auth')
        @endauth
        @guest()
            @include('layouts.page_templates.guest')
        @endguest
        </div>
    </body>
    <script src="/js/apexcharts.min.js" type="text/javascript"></script>
    <script src="/js/dash_1.js" type="text/javascript"></script>
</html>