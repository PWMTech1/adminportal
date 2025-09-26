<?php
use App\Http\Controllers\HomeController;
use App\Roles;
$permissions = HomeController::getAllPermissionsPerUser();

?>

<style>
/* MatDash Sidebar Styles */
.sidebar-nav {
    width: 280px;
    height: 100vh;
    background: #fff;
    border-right: 1px solid #e5e7eb;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000;
    overflow-y: auto;
    transition: all 0.3s ease;
}

.sidebar-container {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    padding: 1.5rem 1.25rem;
    border-bottom: 1px solid #e5e7eb;
    background: #f8fafc;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.sidebar-logo {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    object-fit: contain;
}

.logo-text {
    flex: 1;
}

.logo-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
    line-height: 1.2;
}

.logo-subtitle {
    font-size: 0.75rem;
    color: #6b7280;
    font-weight: 500;
}

.sidebar-menu {
    flex: 1;
    padding: 1rem 0;
}

.nav-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-item {
    margin: 0.25rem 0.75rem;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: #6b7280;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-weight: 500;
    font-size: 0.875rem;
    position: relative;
}

.nav-link:hover {
    background: #f3f4f6;
    color: #374151;
    text-decoration: none;
}

.nav-item.active .nav-link {
    background: #3b82f6;
    color: #fff;
    font-weight: 600;
}

.nav-item.active .nav-link::before {
    content: '';
    position: absolute;
    left: -0.75rem;
    top: 50%;
    transform: translateY(-50%);
    width: 3px;
    height: 20px;
    background: #3b82f6;
    border-radius: 0 2px 2px 0;
}

.nav-icon {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
}

.nav-text {
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.logout-item {
    margin-top: auto;
    border-top: 1px solid #e5e7eb;
    padding-top: 0.5rem;
}

.logout-link {
    color: #dc2626 !important;
}

.logout-link:hover {
    background: #fef2f2 !important;
    color: #dc2626 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar-nav {
        width: 100%;
        transform: translateX(-100%);
    }
    
    .sidebar-nav.open {
        transform: translateX(0);
    }
}

/* Scrollbar Styling */
.sidebar-nav::-webkit-scrollbar {
    width: 4px;
}

.sidebar-nav::-webkit-scrollbar-track {
    background: #f1f5f9;
}

.sidebar-nav::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 2px;
}

.sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>

<nav class="sidebar-nav">
    <div class="sidebar-container">
        <!-- Logo Section -->
        <div class="sidebar-header">
            <div class="logo-container">
                <img src="https://www.pinnaclewoundmanagement.com/images/pinnacle-logo-color.png" alt="Pinnacle Wound Management" class="sidebar-logo">
                <div class="logo-text">
                    <h3 class="logo-title">Pinnacle Wound Care</h3>
                    <span class="logo-subtitle">Admin Portal</span>
                </div>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <div class="sidebar-menu">
            <ul class="nav-list">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="nav-icon">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                @if ($permissions->permissions & Roles::USER_MANAGEMENT or $permissions->AllowAll)
                    <li class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="nav-icon">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="nav-text">User Management</span>
                        </a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::FACILITY_MANAGEMENT || $permissions->AllowAll)
                    <li class="nav-item {{ request()->is('facility/*') ? 'active' : '' }}">
                        <a href="/facility/list" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="nav-icon">
                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                <line x1="12" y1="11" x2="12" y2="17"></line>
                                <line x1="9" y1="14" x2="15" y2="14"></line>
                            </svg>
                            <span class="nav-text">Facility Management</span>
                        </a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::STIPHDENS_ADJUSTMENTS || $permissions->AllowAll)
                    <li class="nav-item {{ request()->is('formexplorer*') ? 'active' : '' }}">
                        <a href="/formexplorer" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="nav-icon">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            <span class="nav-text">Clinician Adjustments</span>
                        </a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::PATIENT || $permissions->AllowAll)
                    <li class="nav-item {{ request()->is('addpatient*') ? 'active' : '' }}">
                        <a href="/addpatient" class="nav-link">
                            <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="nav-icon">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span class="nav-text">Patient Registration</span>
                        </a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::ORDER_SUPPLIES || $permissions->AllowAll)
                    <li class="nav-item {{ request()->is('forms/ordersupplies*') ? 'active' : '' }}">
                        <a href="/forms/ordersupplies" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="nav-icon">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span class="nav-text">Order Supplies</span>
                        </a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::WOUNDTRACKER || $permissions->AllowAll)
                    <li class="nav-item {{ request()->is('visitsandpatients*') ? 'active' : '' }}">
                        <a href="/visitsandpatients" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="nav-icon">
                                <circle cx="12" cy="12" r="10"></circle>
                                <circle cx="12" cy="12" r="6"></circle>
                                <circle cx="12" cy="12" r="2"></circle>
                            </svg>
                            <span class="nav-text">New Visits</span>
                        </a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::COMPENSATION || $permissions->AllowAll)
                    <li class="nav-item {{ request()->is('ffs/compensation*') ? 'active' : '' }}">
                        <a href="/ffs/compensation" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="nav-icon">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span class="nav-text">Clinician Compensation</span>
                        </a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::PCC || $permissions->AllowAll)
                    <li class="nav-item {{ request()->is('pcc/*') ? 'active' : '' }}">
                        <a href="/pcc/facilitylist" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="nav-icon">
                                <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                                <line x1="12" y1="22" x2="12" y2="15.5"></line>
                                <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                                <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                                <line x1="12" y1="2" x2="12" y2="8.5"></line>
                            </svg>
                            <span class="nav-text">PointClickCare</span>
                        </a>
                    </li>
                @endif
                @if ($permissions->permissions & Roles::REPORTS || $permissions->AllowAll)
                    <li class="nav-item {{ request()->routeIs('reports*') ? 'active' : '' }}">
                        <a href="{{ route('reports') }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="nav-icon">
                                <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                                <line x1="12" y1="22" x2="12" y2="15.5"></line>
                                <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                                <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                                <line x1="12" y1="2" x2="12" y2="8.5"></line>
                            </svg>
                            <span class="nav-text">Reports</span>
                        </a>
                    </li>
                @endif
                @if ($permissions->AllowAll)
                    <li class="nav-item {{ request()->routeIs('crmworklist*') ? 'active' : '' }}">
                        <a href="{{ route('crmworklist') }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="nav-icon">
                                <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                                <line x1="12" y1="22" x2="12" y2="15.5"></line>
                                <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                                <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                                <line x1="12" y1="2" x2="12" y2="8.5"></line>
                            </svg>
                            <span class="nav-text">CRM WorkList</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item logout-item">
                    <a href="{{ route('logout') }}" class="nav-link logout-link"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="nav-icon">
                            <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                            <polygon points="12 15 17 21 7 21 12 15"></polygon>
                        </svg>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>