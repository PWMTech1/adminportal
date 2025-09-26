<?php
use App\Http\Controllers\HomeController;
use App\Roles;
$permissions = HomeController::getAllPermissionsPerUser();

?>

<div class="overlay"></div>
<div class="search-overlay"></div>

<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="{{ route('home') }}" data-active="{{ $activePage == 'dashboard' ? 'true' : 'false' }}" class="dropdown-toggle {{$activePage == 'dashboard' ? "bg-primary text-white" : ""}}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </div>
                </a>                
            </li>
            @if(($permissions->permissions & Roles::USER_MANAGEMENT) OR $permissions->AllowAll)
            <li class="menu">
                <a href="{{ route('user.index') }}" data-active="{{ $activePage == 'user-management' ? 'true' : 'false' }}" class="dropdown-toggle {{$activePage == 'user-management' ? "bg-primary text-white" : ""}}">
                    <div class="">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>User Management</span>
                    </div>
                </a>
            </li>
            @endif
            @if(($permissions->permissions & Roles::FACILITY_MANAGEMENT) || $permissions->AllowAll)
            <li class="menu">
                <a href="/facility/list" data-active="{{$activePage == 'facility-management' ? "true" : "false"}}" class="dropdown-toggle {{$activePage == 'facility-management' ? "bg-primary text-white" : ""}}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-plus"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg>
                        <span>Facility Management</span>
                    </div>
                </a>                
            </li>
            @endif
            @if(($permissions->permissions & Roles::STIPHDENS_ADJUSTMENTS) || $permissions->AllowAll)
            <li class="menu">
                <a href="/formexplorer" data-active="{{$activePage == 'adjustments' ? "true" : "false"}}" class="dropdown-toggle {{$activePage == 'adjustments' ? "bg-primary text-white" : ""}}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        <span>Clinician Adjustments</span>
                    </div>
                </a>
            </li>
            @endif
            @if(($permissions->permissions & Roles::PATIENT) || $permissions->AllowAll)
            <li class="menu">
                <a href="/addpatient" data-active="{{$activePage == 'addpatient' ? "true" : "false"}}" class="dropdown-toggle {{$activePage == 'addpatient' ? "bg-primary text-white" : ""}}">
                    <div class="">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                        <span>Patient Registration</span>
                    </div>
                </a>
            </li>
            @endif
            @if(($permissions->permissions & Roles::ORDER_SUPPLIES) || $permissions->AllowAll)
            <li class="menu">
                <a href="/forms/ordersupplies" data-active="{{$activePage == 'ordersupplies' ? "true" : "false"}}" class="dropdown-toggle {{$activePage == 'ordersupplies' ? "bg-primary text-white" : ""}}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Order Supplies</span>
                    </div>
                </a>                
            </li>
            @endif
            @if(($permissions->permissions & Roles::WOUNDTRACKER) || $permissions->AllowAll)
            <li class="menu">
                <a href="/visitsandpatients" data-active="{{$activePage == 'woundtracker' ? "true" : "false"}}" class="dropdown-toggle {{$activePage == 'woundtracker' ? "bg-primary text-white" : ""}}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                        <span>New Visits</span>
                    </div>
                </a>
            </li>
            @endif
            @if(($permissions->permissions & Roles::COMPENSATION) || $permissions->AllowAll)
            <li class="menu">
                <a href="/ffs/compensation" data-active="{{$activePage == 'compensation' ? "true" : "false"}}" class="dropdown-toggle {{$activePage == 'compensation' ? "bg-primary text-white" : ""}}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Clinician Compensation</span>
                    </div>
                </a>                
            </li>
            @endif
            @if(($permissions->permissions & Roles::PCC) || $permissions->AllowAll)
            <li class="menu">
                <a href="/pcc/facilitylist" data-active="{{$activePage == 'pcc' ? "true" : "false"}}" class="dropdown-toggle {{$activePage == 'pcc' ? "bg-primary text-white" : ""}}">
                    <div class="">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-codepen"><polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon><line x1="12" y1="22" x2="12" y2="15.5"></line><polyline points="22 8.5 12 15.5 2 8.5"></polyline><polyline points="2 15.5 12 8.5 22 15.5"></polyline><line x1="12" y1="2" x2="12" y2="8.5"></line></svg>
                        <span>PointClickCare</span>
                    </div>
                </a>                
            </li>
            @endif
            <li class="menu">
                <a href="{{ route('logout') }}" class="dropdown-toggle" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                        <span>Logout</span>
                    </div>
                </a>
            </li>

        </ul>

    </nav>

</div>