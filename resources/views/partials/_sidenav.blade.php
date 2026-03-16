@php
    use App\Models\User;

    $user       = auth()->user();
    $role       = $user?->role;
    $subconRole = $user?->subcon_role; // pm | lineman

    $dashUrl = match(true) {
        $role === User::ROLE_SUBCON && $subconRole === User::SUBCON_PM      => route('subcon.pm.index'),
        $role === User::ROLE_SUBCON && $subconRole === User::SUBCON_LINEMAN => route('subcon.lineman.nodes'),
        default => route('dashboard'),
    };

    $isAdmin          = $role === User::ROLE_ADMIN;
    $isWarehouseInCharge = $user && $user->isWarehouseInCharge();
@endphp

<div class="app-menu">

    <!-- Sidenav Brand Logo -->
    <a href="#" class="logo-box">
        <div class="logo-light">
            <img src="{{ asset('assets/images/logo-light.png') }}" class="logo-lg" alt="Light logo">
            <img src="{{ asset('assets/images/logo-sm.png') }}" class="logo-sm" alt="Small logo">
        </div>
        <div class="logo-dark">
            <img src="{{ asset('assets/images/logo-dark.png') }}" class="logo-lg" alt="Dark logo" style="height:80px" width="200px">
            <img src="{{ asset('assets/images/logo-sm.png') }}" class="logo-sm" alt="Small logo">
        </div>
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
        <span class="sr-only">Menu Toggle Button</span>
        <i class="mgc_round_line text-xl"></i>
    </button>

    <!--- Menu -->
    <div class="srcollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">

            {{-- ── COMMON: Dashboard (all roles) ── --}}
            <li class="menu-title">Menu</li>

            <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ $dashUrl }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            @switch($role)

                {{-- ══════════════════════════════════════
                     ADMIN
                ══════════════════════════════════════ --}}
                @case(User::ROLE_ADMIN)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('exec.reports.*') ? 'active' : '' }}">
                        <a href="{{ route('exec.reports.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_file_check_line"></i></span>
                            <span class="menu-text">Daily Reports</span>
                        </a>
                    </li>

                    <li class="menu-title">Administration</li>

                    <li class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_user_add_line"></i></span>
                            <span class="menu-text">User Management</span>
                        </a>
                    </li>

                      <li class="menu-item {{ request()->routeIs('admin.projects.*') ? 'active open' : '' }}">
                        <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                            <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                            <span class="menu-text">Projects</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="sub-menu {{ request()->routeIs('admin.projects.*') ? '' : 'hidden' }}">
                            <li class="menu-item {{ request()->routeIs('admin.projects.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.projects.index') }}" class="menu-link">
                                    <span class="menu-text">Project List</span>
                                </a>
                            </li>
                        
                        </ul>
                    </li>

                    <li class="menu-item {{ request()->routeIs('admin.subcons.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.subcons.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_user_3_line"></i></span>
                            <span class="menu-text">Subcontractors</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('admin.warehouses.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.warehouses.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                            <span class="menu-text">Add Warehouse</span>
                        </a>
                    </li>

                  

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_file_lock_line"></i></span>
                            <span class="menu-text">System Logs</span>
                        </a>
                    </li>

                    @break

                {{-- ══════════════════════════════════════
                     EXECUTIVES
                ══════════════════════════════════════ --}}
                @case(User::ROLE_EXECUTIVES)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('exec.reports.*') ? 'active' : '' }}">
                        <a href="{{ route('exec.reports.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_file_check_line"></i></span>
                            <span class="menu-text">Daily Reports</span>
                        </a>
                    </li>

                    <li class="menu-title">Executive</li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                            <span class="menu-text">Projects &amp; Finances</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_task_2_line"></i></span>
                            <span class="menu-text">Project Progress View</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('admin.projects.*') ? 'active open' : '' }}">
                        <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                            <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                            <span class="menu-text">Projects</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="sub-menu {{ request()->routeIs('admin.projects.*') ? '' : 'hidden' }}">
                            <li class="menu-item {{ request()->routeIs('admin.projects.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.projects.index') }}" class="menu-link">
                                    <span class="menu-text">Project List</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="menu-link">
                                    <span class="menu-text">Detail (coming soon)</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                            <span class="menu-text">Tickets</span>
                        </a>
                    </li>

                    @break

                {{-- ══════════════════════════════════════
                     HR
                ══════════════════════════════════════ --}}
                @case(User::ROLE_HR)

                    <li class="menu-title">HR</li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_user_line"></i></span>
                            <span class="menu-text">Employees</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_task_2_line"></i></span>
                            <span class="menu-text">Payroll</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                            <span class="menu-text">Tickets</span>
                        </a>
                    </li>

                    @break

                {{-- ══════════════════════════════════════
                     ACCOUNTING
                ══════════════════════════════════════ --}}
                @case(User::ROLE_ACCOUNTING)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('exec.reports.*') ? 'active' : '' }}">
                        <a href="{{ route('exec.reports.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_file_check_line"></i></span>
                            <span class="menu-text">Daily Reports</span>
                        </a>
                    </li>

                    <li class="menu-title">Accounting</li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                            <span class="menu-text">Accounts Payable</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_receipt_line"></i></span>
                            <span class="menu-text">Accounts Receivable</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                            <span class="menu-text">Tickets</span>
                        </a>
                    </li>

                    @break

                {{-- ══════════════════════════════════════
                     PROJECT MANAGER
                ══════════════════════════════════════ --}}
                @case(User::ROLE_PROJECT_MANAGER)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('exec.reports.*') ? 'active' : '' }}">
                        <a href="{{ route('exec.reports.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_file_check_line"></i></span>
                            <span class="menu-text">Daily Reports</span>
                        </a>
                    </li>

                    <li class="menu-title">Projects</li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_calendar_line"></i></span>
                            <span class="menu-text">Task Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_task_2_line"></i></span>
                            <span class="menu-text">My Projects</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_folder_2_line"></i></span>
                            <span class="menu-text">File Manager</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                            <span class="menu-text">Tickets</span>
                        </a>
                    </li>

                    @break

                {{-- ══════════════════════════════════════
                     NORMAL EMPLOYEE
                ══════════════════════════════════════ --}}
                @case(User::ROLE_NORMAL_EMPLOYEE)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('exec.reports.*') ? 'active' : '' }}">
                        <a href="{{ route('exec.reports.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_file_check_line"></i></span>
                            <span class="menu-text">Daily Reports</span>
                        </a>
                    </li>

                    <li class="menu-title">Employee</li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_calendar_line"></i></span>
                            <span class="menu-text">Task Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_folder_2_line"></i></span>
                            <span class="menu-text">File Manager</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_task_2_line"></i></span>
                            <span class="menu-text">Payroll Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                            <span class="menu-text">Tickets</span>
                        </a>
                    </li>

                    @break

                {{-- ══════════════════════════════════════
                     SUBCON — PM / LINEMAN
                ══════════════════════════════════════ --}}
                @case(User::ROLE_SUBCON)

                    @if($subconRole === User::SUBCON_PM)

                        <li class="menu-title">PM — {{ $user->subcontractor->name ?? 'Subcon' }}</li>

                        <li class="menu-item {{ request()->routeIs('subcon.pm.index') ? 'active' : '' }}">
                            <a href="{{ route('subcon.pm.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="mgc_clipboard_line"></i></span>
                                <span class="menu-text">PM Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-item {{ request()->routeIs('subcon.pm.show') ? 'active' : '' }}">
                            <a href="{{ route('subcon.pm.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="mgc_document_line"></i></span>
                                <span class="menu-text">Daily Reports</span>
                            </a>
                        </li>

                    @elseif($subconRole === User::SUBCON_LINEMAN)

                        <li class="menu-title">Lineman — {{ $user->subcontractor->name ?? 'Subcon' }}</li>

                        <li class="menu-item {{ request()->routeIs('subcon.lineman.nodes') ? 'active' : '' }}">
                            <a href="{{ route('subcon.lineman.nodes') }}" class="menu-link">
                                <span class="menu-icon"><i class="mgc_hard_hat_line"></i></span>
                                <span class="menu-text">My Work Today</span>
                            </a>
                        </li>

                        <li class="menu-item {{ request()->routeIs('subcon.lineman.report', 'subcon.lineman.pole.report') ? 'active' : '' }}">
                            <a href="{{ route('subcon.lineman.nodes') }}" class="menu-link">
                                <span class="menu-icon"><i class="mgc_telegraph_pole_line"></i></span>
                                <span class="menu-text">Pole Reports</span>
                            </a>
                        </li>

                    @endif

                    @break

@default
                    {{-- no extra items --}}

            @endswitch

            {{-- ══════════════════════════════════════
                 WAREHOUSE — admin + any in-charge user
            ══════════════════════════════════════ --}}
            @if($isAdmin || $isWarehouseInCharge)

                <li class="menu-title">Warehouse</li>

                <li class="menu-item {{ request()->routeIs('warehouse.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('warehouse.dashboard') }}" class="menu-link">
                        <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                        <span class="menu-text">Warehouse Dashboard</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('warehouse.requests.*') ? 'active' : '' }}">
                    <a href="{{ route('warehouse.requests.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="mgc_truck_line"></i></span>
                        <span class="menu-text">Delivery Requests</span>
                    </a>
                </li>

            @endif

        </ul>
    </div>
</div>
