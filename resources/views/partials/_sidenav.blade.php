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

    $isAdmin             = $role === User::ROLE_ADMIN;
    $isWarehouseInCharge = $user && $user->isWarehouseInCharge();
    $canSeePlanner       = in_array($role, ['admin', 'pm', 'project_manager', 'executives', 'subcon']);
    $canSeeWarehouse     = $isAdmin
        || $isWarehouseInCharge
        || $role === User::ROLE_PROJECT_MANAGER
        || $role === 'executives'
        || ($role === User::ROLE_SUBCON && $user->subcontractor_id);
@endphp

@push('styles')
<style>
:root{
  --sb-bg:#f6f9fc;
  --sb-card:#ffffff;
  --sb-line:#e7eef6;
  --sb-line-2:#d7e3f0;
  --sb-text:#0f172a;
  --sb-text-2:#4b5b75;
  --sb-text-3:#8a9ab2;

  --sb-blue:#2563eb;
  --sb-blue-2:#1d4ed8;
  --sb-blue-soft:rgba(37,99,235,.08);

  --sb-violet:#7c3aed;
  --sb-violet-soft:rgba(124,58,237,.08);

  --sb-shadow:0 12px 30px rgba(15,23,42,.06);
}

.app-menu{
  background:linear-gradient(180deg,#f8fbff 0%, #f2f7fc 100%);
  border-inline-end:1px solid var(--sb-line);
  padding:14px 12px 14px;
}

.app-menu .srcollbar,
.app-menu [data-simplebar]{
  height:calc(100vh - 90px);
}

.app-menu .simplebar-content{
  display:flex;
  flex-direction:column;
  gap:10px;
}

.logo-box{
  position:relative;
  display:flex;
  align-items:center;
  justify-content:center;
  min-height:84px;
  margin-bottom:12px;
  border:1px solid var(--sb-line);
  border-radius:24px;
  background:
    radial-gradient(circle at top left, rgba(37,99,235,.07), transparent 30%),
    radial-gradient(circle at top right, rgba(124,58,237,.05), transparent 24%),
    #fff;
  box-shadow:var(--sb-shadow);
  overflow:hidden;
}

.logo-box::after{
  content:"";
  position:absolute;
  inset:auto 0 0 0;
  height:3px;
  background:linear-gradient(90deg,var(--sb-blue),#60a5fa,var(--sb-violet));
  opacity:.95;
}

.logo-light,
.logo-dark{
  display:flex;
  align-items:center;
  justify-content:center;
  width:100%;
  padding:10px 14px;
}

.logo-box img.logo-lg{
  max-height:54px;
  width:auto;
  object-fit:contain;
}

.logo-box img.logo-sm{
  max-height:34px;
  width:auto;
  object-fit:contain;
}

#button-hover-toggle{
  top:18px !important;
  right:14px !important;
  width:34px;
  height:34px;
  display:flex;
  align-items:center;
  justify-content:center;
  border:1px solid var(--sb-line);
  border-radius:999px;
  background:#fff;
  color:var(--sb-text-2);
  box-shadow:0 8px 20px rgba(15,23,42,.06);
  transition:all .16s ease;
}

#button-hover-toggle:hover{
  color:var(--sb-blue);
  border-color:#cddcf0;
  transform:translateY(-1px);
}

.app-menu .menu{
  display:flex;
  flex-direction:column;
  gap:8px;
  padding:0;
  margin:0;
  list-style:none;
}

.app-menu .menu-title{
  margin:14px 8px 4px;
  padding:0 6px;
  font-size:.63rem;
  font-weight:800;
  letter-spacing:.14em;
  text-transform:uppercase;
  color:var(--sb-text-3);
}

.app-menu .menu-item{
  list-style:none;
}

.app-menu .menu-link{
  position:relative;
  display:flex;
  align-items:center;
  gap:12px;
  min-height:46px;
  padding:10px 12px;
  border-radius:14px;
  color:var(--sb-text-2);
  text-decoration:none;
  font-size:.86rem;
  font-weight:700;
  transition:all .16s ease;
  border:1px solid transparent;
}

.app-menu .menu-link:hover{
  background:#fff;
  border-color:var(--sb-line);
  color:var(--sb-text);
  box-shadow:0 8px 22px rgba(15,23,42,.04);
  transform:translateX(2px);
}

.app-menu .menu-item.active > .menu-link{
  background:linear-gradient(180deg, #ffffff 0%, #f7fbff 100%);
  border-color:#dbe7f3;
  color:var(--sb-blue);
  box-shadow:0 10px 24px rgba(37,99,235,.08);
}

.app-menu .menu-item.active > .menu-link::before{
  content:"";
  position:absolute;
  left:-2px;
  top:8px;
  bottom:8px;
  width:4px;
  border-radius:999px;
  background:linear-gradient(180deg,var(--sb-blue),#60a5fa);
}

.app-menu .menu-icon{
  width:34px;
  height:34px;
  flex-shrink:0;
  display:flex;
  align-items:center;
  justify-content:center;
  border-radius:12px;
  background:#f7faff;
  border:1px solid var(--sb-line);
  color:var(--sb-text-2);
  font-size:1rem;
  transition:all .16s ease;
}

.app-menu .menu-link:hover .menu-icon{
  background:var(--sb-blue-soft);
  border-color:rgba(37,99,235,.10);
  color:var(--sb-blue);
}

.app-menu .menu-item.active > .menu-link .menu-icon{
  background:var(--sb-blue-soft);
  border-color:rgba(37,99,235,.10);
  color:var(--sb-blue);
}

.app-menu .menu-text{
  flex:1;
  min-width:0;
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}

.app-menu .menu-arrow{
  width:10px;
  height:10px;
  border-right:2px solid var(--sb-text-3);
  border-bottom:2px solid var(--sb-text-3);
  transform:rotate(45deg);
  margin-top:-4px;
  transition:all .18s ease;
}

.app-menu .menu-item.open > .menu-link .menu-arrow,
.app-menu .menu-item.active.open > .menu-link .menu-arrow{
  transform:rotate(225deg);
  margin-top:2px;
  border-color:var(--sb-blue);
}

.app-menu .sub-menu{
  position:relative;
  list-style:none;
  margin:8px 0 2px 18px;
  padding:10px 0 4px 16px;
  border-left:1px dashed #d7e3f0;
}

.app-menu .sub-menu.hidden{
  display:none;
}

.app-menu .sub-menu .menu-item{
  margin-bottom:6px;
}

.app-menu .sub-menu .menu-link{
  min-height:40px;
  padding:8px 12px;
  font-size:.8rem;
  font-weight:700;
  border-radius:12px;
  color:var(--sb-text-2);
  background:transparent;
}

.app-menu .sub-menu .menu-link:hover{
  background:#fff;
  border-color:var(--sb-line);
  transform:none;
}

.app-menu .sub-menu .menu-item.active > .menu-link{
  background:var(--sb-blue-soft);
  color:var(--sb-blue);
  border-color:rgba(37,99,235,.08);
  box-shadow:none;
}

.app-menu .sub-menu .menu-item.active > .menu-link::before{
  display:none;
}

.app-menu .sub-menu .menu-text{
  font-size:.79rem;
}

.sidenav-collapsed .app-menu .menu-text,
.sidenav-collapsed .app-menu .menu-title{
  display:none;
}

.sidenav-collapsed .app-menu .menu-link{
  justify-content:center;
  padding-inline:8px;
}

.sidenav-collapsed .app-menu .menu-icon{
  margin:0;
}

.sidenav-collapsed .app-menu .sub-menu{
  display:none !important;
}
</style>
@endpush

<div class="app-menu">

    <!-- Sidenav Brand Logo -->
    <a href="{{ $dashUrl }}" class="logo-box">
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

            {{-- COMMON: Dashboard --}}
            <li class="menu-title">Menu</li>

            <li class="menu-item {{ request()->routeIs('dashboard', 'subcon.pm.index', 'subcon.lineman.nodes') ? 'active' : '' }}">
                <a href="{{ $dashUrl }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            @switch($role)

                {{-- ADMIN --}}
                @case(User::ROLE_ADMIN)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <a href="{{ route('reports.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_file_check_line"></i></span>
                            <span class="menu-text">Daily Reports</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('planner.*') ? 'active' : '' }}">
                        <a href="{{ route('planner.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_location_line"></i></span>
                            <span class="menu-text">Pole GPS Planner</span>
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

                {{-- EXECUTIVES --}}
                @case(User::ROLE_EXECUTIVES)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <a href="{{ route('reports.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_file_check_line"></i></span>
                            <span class="menu-text">Daily Reports</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('planner.*') ? 'active' : '' }}">
                        <a href="{{ route('planner.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_location_line"></i></span>
                            <span class="menu-text">Pole GPS Planner</span>
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

                {{-- HR --}}
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

                {{-- ACCOUNTING --}}
                @case(User::ROLE_ACCOUNTING)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <a href="{{ route('reports.index') }}" class="menu-link">
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

                {{-- PROJECT MANAGER --}}
                @case(User::ROLE_PROJECT_MANAGER)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <a href="{{ route('reports.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_file_check_line"></i></span>
                            <span class="menu-text">Daily Reports</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('planner.*') ? 'active' : '' }}">
                        <a href="{{ route('planner.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_location_line"></i></span>
                            <span class="menu-text">Pole GPS Planner</span>
                        </a>
                    </li>

                    <li class="menu-title">Projects</li>

                    <li class="menu-item {{ request()->routeIs('pm.projects.*') ? 'active open' : '' }}">
                        <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                            <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                            <span class="menu-text">Projects</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="sub-menu {{ request()->routeIs('pm.projects.*') ? '' : 'hidden' }}">
                            <li class="menu-item {{ request()->routeIs('pm.projects.index') ? 'active' : '' }}">
                                <a href="{{ route('pm.projects.index') }}" class="menu-link">
                                    <span class="menu-text">Project List</span>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('pm.projects.nodes.*') ? 'active' : '' }}">
                                <a href="{{ route('pm.projects.index') }}" class="menu-link">
                                    <span class="menu-text">Node List</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @break

                {{-- NORMAL EMPLOYEE --}}
                @case(User::ROLE_NORMAL_EMPLOYEE)

                    <li class="menu-title">Reports</li>

                    <li class="menu-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <a href="{{ route('reports.index') }}" class="menu-link">
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

                {{-- SUBCON --}}
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

                        <li class="menu-item {{ request()->routeIs('planner.*') ? 'active' : '' }}">
                            <a href="{{ route('planner.index') }}" class="menu-link">
                                <span class="menu-icon"><i class="mgc_location_line"></i></span>
                                <span class="menu-text">Pole GPS Planner</span>
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

            {{-- WAREHOUSE --}}
            @if($canSeeWarehouse)

                <li class="menu-title">Warehouse</li>

                <li class="menu-item {{ request()->routeIs('warehouse.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('warehouse.dashboard') }}" class="menu-link">
                        <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                        <span class="menu-text">Warehouse Dashboard</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('warehouse.transmittals.*') ? 'active' : '' }}">
                    <a href="{{ route('warehouse.transmittals.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="mgc_truck_line"></i></span>
                        <span class="menu-text">Transmittals</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('warehouse.deliveries.*') ? 'active' : '' }}">
                    <a href="{{ route('warehouse.deliveries.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="mgc_map_line"></i></span>
                        <span class="menu-text">Deliveries</span>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('warehouse.inventory.*') ? 'active' : '' }}">
                    <a href="{{ route('warehouse.inventory.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="mgc_inventory_line"></i></span>
                        <span class="menu-text">Inventory</span>
                    </a>
                </li>

            @endif

        </ul>
    </div>
</div>