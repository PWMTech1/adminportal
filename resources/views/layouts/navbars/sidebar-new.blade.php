<?php
use App\Http\Controllers\HomeController;
use App\Roles;
$permissions = HomeController::getAllPermissionsPerUser();

?>

<nav class=" rounded-md w-1/6 h-screen flex-col justify-between sticky top-0">
    <div class=" bg-blue-900 h-full">
        <div class="flex  justify-center py-10 shadow-xl pr-4">
            <div class="">

                <p class="text-2xl font-medium text-sky-300 text-center">Innovative Med Solution</h1>
                    <span class="text-sm block text-gray-50">{{ $titlePage }}</span>
            </div>
        </div>
        <div class="pl-8">
            <ul class="space-y-2 pt-10">
                <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <a href="{{ route('home') }}" class="text-gray-50 hover:text-gray-300 text-sm">Dashboard</a>
                </li>
                @if ($permissions->permissions & Roles::USER_MANAGEMENT or $permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <a href="{{ route('user.index') }}" class="text-gray-50 hover:text-gray-300 text-sm">User
                            Management</a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::FACILITY_MANAGEMENT || $permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-folder-plus">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z">
                            </path>
                            <line x1="12" y1="11" x2="12" y2="17"></line>
                            <line x1="9" y1="14" x2="15" y2="14"></line>
                        </svg>
                        <a href="/facility/list" class="text-gray-50 hover:text-gray-300 text-sm">Facility
                            Management</a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::STIPHDENS_ADJUSTMENTS || $permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <a href="/formexplorer" class="text-gray-50 hover:text-gray-300 text-sm">Clinician
                            Adjustments</a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::PATIENT || $permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        <a href="/addpatient" class="text-gray-50 hover:text-gray-300 text-sm">Patient Registration</a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::ORDER_SUPPLIES || $permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <a href="/forms/ordersupplies" class="text-gray-50 hover:text-gray-300 text-sm">Order
                            Supplies</a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::WOUNDTRACKER || $permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-target">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                        <a href="/visitsandpatients" class="text-gray-50 hover:text-gray-300 text-sm">New Visits</a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::COMPENSATION || $permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <a href="/ffs/compensation" class="text-gray-50 hover:text-gray-300 text-sm">Clinician
                            Compensation</a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::PCC || $permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-codepen">
                            <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                            <line x1="12" y1="22" x2="12" y2="15.5"></line>
                            <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                            <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                            <line x1="12" y1="2" x2="12" y2="8.5"></line>
                        </svg>
                        <a href="/pcc/facilitylist" class="text-gray-50 hover:text-gray-300 text-sm">PointClickCare</a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::REPORTS || $permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-codepen">
                            <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                            <line x1="12" y1="22" x2="12" y2="15.5"></line>
                            <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                            <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                            <line x1="12" y1="2" x2="12" y2="8.5"></line>
                        </svg>
                        <a href="{{ route('reports') }}" class="text-gray-50 hover:text-gray-300 text-sm">Reports</a>
                    </li>
                @endif
                @if ($permissions->AllowAll)
                    <li class="flex space-x-4 items-center text-gray-50 hover:text-gray-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-codepen">
                            <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                            <line x1="12" y1="22" x2="12" y2="15.5"></line>
                            <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                            <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                            <line x1="12" y1="2" x2="12" y2="8.5"></line>
                        </svg>
                        <a href="{{ route('crmworklist') }}" class="text-gray-50 hover:text-gray-300 text-sm">CRM
                            WorkList</a>
                    </li>
                @endif
                <li class="flex space-x-4 items-center text-gray-50 hover:text-indigo-300 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-airplay">
                        <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                        <polygon points="12 15 17 21 7 21 12 15"></polygon>
                    </svg>
                    <a href="{{ route('logout') }}" class="text-gray-50 hover:text-gray-300 text-sm"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
