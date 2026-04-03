<x-layout>
    <style>
        :root {
            --brand: #0A5C3B;
            --brand-dark: #08492F;
            --brand-soft: #EDF7F2;
            --brand-line: #D9E9E1;
            --brand-ink: #073826;
            --text: #14221B;
            --muted: #6B7280;
            --panel: #FFFFFF;
        }

        .user-page-shell {
            width: 100%;
            max-width: 100%;
            padding: 14px;
        }

        @media (min-width: 768px) {
            .user-page-shell {
                padding: 20px;
            }
        }

        @media (min-width: 1280px) {
            .user-page-shell {
                padding: 24px 28px 28px;
            }
        }

        .page-header {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 16px;
        }

        @media (min-width: 768px) {
            .page-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-start;
            }
        }

        .page-title {
            font-size: 1.35rem;
            line-height: 1.08;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--text);
        }

        @media (min-width: 1024px) {
            .page-title {
                font-size: 2rem;
            }
        }

        .page-subtitle {
            margin-top: 6px;
            font-size: 0.92rem;
            color: #5f6b65;
            line-height: 1.55;
            max-width: 900px;
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            width: 100%;
            min-height: 52px;
            padding: .95rem 1.2rem;
            border-radius: 18px;
            background: linear-gradient(180deg, #0A5C3B 0%, #084B30 100%);
            color: #fff;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(10, 92, 59, 0.20);
            transition: all .2s ease;
        }

        @media (min-width: 640px) {
            .primary-btn {
                width: auto;
            }
        }

        .primary-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(10, 92, 59, 0.24);
        }

        .subtle-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .82rem 1rem;
            border-radius: 14px;
            background: #fff;
            border: 1px solid #dde7e1;
            color: #33423a;
            transition: .2s ease;
            min-height: 48px;
        }

        .subtle-btn:hover {
            background: #f8fbf9;
        }

        .panel-card {
            background: var(--panel);
            border: 1px solid var(--brand-line);
            border-radius: 28px;
            box-shadow:
                0 16px 40px rgba(15, 23, 42, 0.05),
                0 2px 10px rgba(10, 92, 59, 0.04);
            overflow: hidden;
        }

        .panel-topbar {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            padding: 14px;
            background:
                radial-gradient(circle at top left, rgba(10, 92, 59, 0.08), transparent 28%),
                linear-gradient(180deg, #ffffff 0%, #f7faf8 100%);
            border-bottom: 1px solid var(--brand-line);
        }

        @media (min-width: 1024px) {
            .panel-topbar {
                grid-template-columns: minmax(280px, 420px) 1fr;
                align-items: center;
                gap: 16px;
                padding: 18px 20px;
            }
        }

        .search-wrap {
            position: relative;
            width: 100%;
        }

        .search-wrap input,
        .ui-field,
        .ui-select {
            width: 100%;
            border: 1px solid #dbe5df;
            background: rgba(255,255,255,0.96);
            color: #17211c;
            border-radius: 16px;
            transition: all .2s ease;
        }

        .search-wrap input {
            padding: 0.95rem 1rem 0.95rem 2.9rem;
            font-size: 0.94rem;
        }

        .ui-field,
        .ui-select {
            padding: 0.82rem 0.95rem;
            font-size: 0.94rem;
            min-height: 52px;
        }

        .search-wrap input:focus,
        .ui-field:focus,
        .ui-select:focus {
            outline: none;
            border-color: rgba(10, 92, 59, 0.55);
            box-shadow: 0 0 0 4px rgba(10, 92, 59, 0.10);
        }

        .search-wrap .material-symbols-rounded {
            position: absolute;
            left: 0.95rem;
            top: 50%;
            transform: translateY(-50%);
            color: #7b8a82;
            font-size: 1.1rem;
        }

        .users-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            color: #67756d;
            font-size: 0.82rem;
        }

        @media (min-width: 1024px) {
            .users-meta {
                justify-content: flex-end;
            }
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .65rem .95rem;
            border-radius: 999px;
            background: #eef7f2;
            color: var(--brand-ink);
            border: 1px solid #d7e9df;
            font-weight: 700;
        }

        .desktop-table-wrap {
            display: none;
        }

        @media (min-width: 768px) {
            .desktop-table-wrap {
                display: block;
                overflow-x: auto;
            }
        }

        .desktop-table {
            width: 100%;
            min-width: 1080px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .desktop-table thead th {
            text-align: left;
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #708078;
            padding: 1rem 1.1rem;
            background: linear-gradient(180deg, #fbfdfc 0%, #f3f8f5 100%);
            border-bottom: 1px solid #e5eee8;
            white-space: nowrap;
        }

        .desktop-table tbody tr {
            transition: background .18s ease;
        }

        .desktop-table tbody tr:hover {
            background: #f9fcfa;
        }

        .desktop-table tbody td {
            padding: 1rem 1.1rem;
            border-bottom: 1px solid #edf3ef;
            vertical-align: middle;
        }

        .mobile-cards {
            display: grid;
            gap: 12px;
            padding: 12px;
        }

        @media (min-width: 768px) {
            .mobile-cards {
                display: none;
            }
        }

        .user-mobile-card {
            border: 1px solid #e3eee8;
            border-radius: 22px;
            background: #fff;
            padding: 14px;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.03);
        }

        .mobile-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 12px;
        }

        .mobile-card-grid {
            display: grid;
            gap: 10px;
        }

        .mobile-meta-row {
            display: grid;
            grid-template-columns: 96px 1fr;
            gap: 10px;
            align-items: start;
        }

        .mobile-label {
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #7a867f;
            padding-top: 3px;
        }

        .user-stack {
            display: flex;
            align-items: center;
            gap: .9rem;
            min-width: 0;
        }

        .avatar-ring {
            width: 46px;
            height: 46px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .92rem;
            font-weight: 800;
            flex-shrink: 0;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.18);
        }

        .user-name {
            font-size: .97rem;
            font-weight: 700;
            color: #1c2822;
            line-height: 1.15;
        }

        .user-sub {
            font-size: .8rem;
            color: #8a958f;
            margin-top: .18rem;
        }

        .email-text {
            color: #55625c;
            word-break: break-word;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: .42rem .82rem;
            border-radius: 999px;
            font-size: .76rem;
            font-weight: 800;
            line-height: 1;
            white-space: nowrap;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .45rem .78rem;
            border-radius: 999px;
            font-size: .76rem;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-dot {
            width: .45rem;
            height: .45rem;
            border-radius: 999px;
            display: inline-block;
        }

        .status-active {
            background: #EAF8F0;
            color: #0B6B43;
        }

        .status-active .status-dot {
            background: #12A05C;
            box-shadow: 0 0 0 4px rgba(18,160,92,0.10);
        }

        .status-inactive {
            background: #FFF1F1;
            color: #DC3C3C;
        }

        .status-inactive .status-dot {
            background: #EF4444;
            box-shadow: 0 0 0 4px rgba(239,68,68,0.10);
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: .45rem;
        }

        .icon-action {
            width: 2.35rem;
            height: 2.35rem;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all .18s ease;
            border: 1px solid transparent;
            flex: 0 0 auto;
        }

        .icon-action:hover {
            transform: translateY(-1px);
        }

        .icon-edit {
            background: #EEF7F2;
            color: var(--brand);
            border-color: #D8EAE1;
        }

        .icon-edit:hover {
            background: #E6F3EC;
        }

        .icon-reset {
            background: #FFF8EA;
            color: #B7791F;
            border-color: #F7E2B2;
        }

        .icon-reset:hover {
            background: #FFF2D8;
        }

        .icon-delete {
            background: #FFF2F2;
            color: #DC3C3C;
            border-color: #FFD9D9;
        }

        .icon-delete:hover {
            background: #FFE9E9;
        }

        @media (max-width: 767px) {
            .action-group {
                flex-wrap: wrap;
                justify-content: flex-start;
            }
        }

        @media (min-width: 768px) {
            .action-group {
                flex-wrap: nowrap;
                justify-content: center;
            }
        }

        .premium-empty {
            padding: 4rem 1rem;
            text-align: center;
            color: #8b978f;
        }

        .premium-empty .material-symbols-rounded {
            font-size: 2.5rem;
            margin-bottom: .5rem;
        }

        .modal-overlay {
            background: rgba(15, 23, 42, 0.42);
            backdrop-filter: blur(4px);
        }

        .modal-shell {
            border-radius: 40px;
            overflow: hidden;
            border: 1px solid #dbe5df;
            background: #fff;
            box-shadow:
                0 24px 60px rgba(15, 23, 42, 0.20),
                0 4px 20px rgba(10, 92, 59, 0.08);
        }

        .modal-head {
            background:
                radial-gradient(circle at top left, rgba(10, 92, 59, 0.10), transparent 40%),
                linear-gradient(180deg, #ffffff 0%, #f7faf8 100%);
            border-bottom: 1px solid #e8efeb;
        }

        .modal-title {
            color: #13221b;
            font-size: 1.03rem;
            font-weight: 800;
        }

        .modal-label {
            display: block;
            margin-bottom: .45rem;
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #67756d;
        }

        .premium-cancel {
            border: 1px solid #dbe5df;
            color: #42514a;
            background: #fff;
            border-radius: 14px;
            padding: .85rem 1rem;
            font-weight: 700;
            min-height: 48px;
        }

        .premium-cancel:hover {
            background: #f8fbf9;
        }

        .danger-btn {
            background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
            border-radius: 14px;
            padding: .85rem 1rem;
            font-weight: 700;
            box-shadow: 0 10px 22px rgba(220, 38, 38, 0.20);
            min-height: 48px;
        }

        .warning-btn {
            background: linear-gradient(180deg, #F59E0B 0%, #D97706 100%);
            color: #fff;
            border-radius: 14px;
            padding: .85rem 1rem;
            font-weight: 700;
            box-shadow: 0 10px 22px rgba(217, 119, 6, 0.18);
            min-height: 48px;
        }

        .premium-note-box {
            border: 1px solid #f2e5b8;
            background: linear-gradient(180deg, #fffdf6 0%, #fff9e9 100%);
            border-radius: 18px;
            padding: 1rem;
        }

        .modal-content-scroll {
            max-height: calc(100vh - 140px);
            overflow-y: auto;
        }

        .modal-footer-stack {
            display: flex;
            flex-direction: column-reverse;
            gap: .75rem;
        }

        .modal-footer-stack > * {
            width: 100%;
        }

        @media (min-width: 640px) {
            .modal-footer-stack {
                flex-direction: row;
                justify-content: flex-end;
                align-items: center;
            }

            .modal-footer-stack > * {
                width: auto;
            }
        }

        .dark .page-title,
        .dark .modal-title,
        .dark .user-name {
            color: #F8FAFC;
        }

        .dark .page-subtitle,
        .dark .users-meta,
        .dark .user-sub,
        .dark .modal-label,
        .dark .mobile-label {
            color: #94A3B8;
        }

        .dark .panel-card,
        .dark .panel-topbar,
        .dark .user-mobile-card {
            background: #0F172A;
            border-color: #334155;
        }

        .dark .panel-topbar {
            background:
                radial-gradient(circle at top left, rgba(10, 92, 59, 0.14), transparent 35%),
                linear-gradient(180deg, #0f172a 0%, #111c31 100%);
        }

        .dark .desktop-table thead th {
            background: linear-gradient(180deg, rgba(30,41,59,0.95) 0%, rgba(15,23,42,0.95) 100%);
            color: #94A3B8;
            border-color: #334155;
        }

        .dark .desktop-table tbody td {
            border-bottom-color: rgba(51,65,85,0.65);
        }

        .dark .desktop-table tbody tr:hover {
            background: rgba(30, 41, 59, 0.55);
        }

        .dark .search-wrap input,
        .dark .ui-field,
        .dark .ui-select {
            background: #182235;
            border-color: #3B4A61;
            color: #F8FAFC;
        }

        .dark .search-wrap .material-symbols-rounded {
            color: #8EA0B8;
        }

        .dark .subtle-btn,
        .dark .premium-cancel,
        .dark .modal-shell {
            background: #132033;
            border-color: #334155;
            color: #E2E8F0;
        }

        .dark .modal-head {
            background:
                radial-gradient(circle at top left, rgba(10, 92, 59, 0.14), transparent 35%),
                linear-gradient(180deg, #132033 0%, #101a2c 100%);
            border-bottom-color: #334155;
        }

        .dark .premium-note-box {
            background: linear-gradient(180deg, rgba(71, 55, 13, 0.22) 0%, rgba(54, 46, 12, 0.15) 100%);
            border-color: rgba(245, 158, 11, 0.28);
        }
    </style>

    <div class="col-span-full user-page-shell">
        @if (session('success'))
            <div class="flex items-center gap-3 px-4 py-3 mb-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                <span class="material-symbols-rounded text-emerald-600">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="page-header">
            <div class="min-w-0">
                <h4 class="page-title">User Management</h4>
                <p class="page-subtitle">Manage all system users, roles, and access.</p>
            </div>

            <button
                class="primary-btn"
                data-fc-type="modal"
                data-fc-target="createUserModal"
                type="button"
            >
                <span class="material-symbols-rounded text-[20px]">person_add</span>
                Add User
            </button>
        </div>

        <div class="panel-card">
            <div class="panel-topbar">
                <div class="search-wrap">
                    <span class="material-symbols-rounded">search</span>
                    <input
                        type="text"
                        id="userSearchInput"
                        placeholder="Search by user name, email, role, or subcontractor..."
                    >
                </div>

                <div class="users-meta">
                    <span class="meta-pill">
                        <span class="material-symbols-rounded text-[18px]">groups</span>
                        <span id="searchResultCount">{{ $users->total() }} users</span>
                    </span>
                </div>
            </div>

            {{-- MOBILE CARDS --}}
            <div id="mobileUserCards" class="mobile-cards">
                @forelse ($users as $user)
                    @php
                        $avatarColors = ['bg-violet-600','bg-cyan-600','bg-emerald-600','bg-pink-600','bg-orange-500','bg-teal-600','bg-rose-600','bg-indigo-600'];
                        $color = $avatarColors[$user->id % count($avatarColors)];

                        $nameParts = explode(' ', trim($user->name));
                        $initials = strtoupper(
                            substr($nameParts[0], 0, 1) .
                            (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : substr($nameParts[0], 1, 1))
                        );

                        $roleLabel = ucfirst(str_replace('_', ' ', $user->role));

                        $roleBadge = match($user->role) {
                            'admin', 'executives', 'hr', 'project_manager' => ['bg' => '#0F4F36', 'text' => '#DDF5E8'],
                            'accounting' => ['bg' => '#8A4B08', 'text' => '#FFF1CB'],
                            'subcon' => ['bg' => '#1E3A8A', 'text' => '#DBEAFE'],
                            'warehouse' => ['bg' => '#065F46', 'text' => '#D1FAE5'],
                            'normal_employee' => ['bg' => '#475569', 'text' => '#F8FAFC'],
                            'visitor' => ['bg' => '#6B7280', 'text' => '#F9FAFB'],
                            default => ['bg' => '#6B7280', 'text' => '#F9FAFB'],
                        };
                    @endphp

                    <div
                        class="user-mobile-card user-row"
                        data-name="{{ strtolower($user->name) }}"
                        data-email="{{ strtolower($user->email) }}"
                        data-role="{{ strtolower(str_replace('_', ' ', $user->role)) }}"
                        data-subcon="{{ strtolower($user->subcontractor->name ?? '') }}"
                    >
                        <div class="mobile-card-top">
                            <div class="user-stack">
                                <div class="avatar-ring {{ $color }}">{{ $initials }}</div>
                                <div class="min-w-0">
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-sub">{{ $roleLabel }}</div>
                                </div>
                            </div>

                            @if($user->is_active)
                                <span class="status-badge status-active">
                                    <span class="status-dot"></span> Active
                                </span>
                            @else
                                <span class="status-badge status-inactive">
                                    <span class="status-dot"></span> Inactive
                                </span>
                            @endif
                        </div>

                        <div class="mobile-card-grid">
                            <div class="mobile-meta-row">
                                <div class="mobile-label">Email</div>
                                <div class="email-text">{{ $user->email }}</div>
                            </div>

                            <div class="mobile-meta-row">
                                <div class="mobile-label">Role</div>
                                <div>
                                    <span class="role-badge" style="background: {{ $roleBadge['bg'] }}; color: {{ $roleBadge['text'] }};">
                                        {{ $roleLabel }}
                                    </span>
                                </div>
                            </div>

                            <div class="mobile-meta-row">
                                <div class="mobile-label">Subcon</div>
                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    @if($user->subcontractor)
                                        <div class="font-semibold text-gray-700 dark:text-gray-200">{{ $user->subcontractor->name }}</div>
                                        <div class="text-xs text-gray-400 mt-1">{{ ucfirst($user->subcon_role) }}</div>
                                    @elseif($user->warehouse_id)
                                        <div class="font-semibold text-gray-700 dark:text-gray-200">Warehouse Assigned</div>
                                        <div class="text-xs text-gray-400 mt-1">Warehouse ID: {{ $user->warehouse_id }}</div>
                                    @else
                                        —
                                    @endif
                                </div>
                            </div>

                            <div class="mobile-meta-row">
                                <div class="mobile-label">Actions</div>
                                <div class="action-group justify-start">
                                    <button
                                        type="button"
                                        title="Edit User"
                                        class="icon-action icon-edit"
                                        data-fc-type="modal"
                                        data-fc-target="editUserModal"
                                        data-user-id="{{ $user->id }}"
                                        data-user-name="{{ $user->name }}"
                                        data-user-email="{{ $user->email }}"
                                        data-user-role="{{ $user->role }}"
                                        data-user-subcon-id="{{ $user->subcon_id }}"
                                        data-user-subcon-role="{{ $user->subcon_role }}"
                                        data-user-status="{{ $user->is_active ? '1' : '0' }}"
                                        data-user-warehouse-id="{{ $user->warehouse_id }}"
                                        onclick="fillEditModal(this)"
                                    >
                                        <span class="material-symbols-rounded text-[18px]">edit</span>
                                    </button>

                                    <button
                                        type="button"
                                        title="Reset Password"
                                        class="icon-action icon-reset"
                                        data-fc-type="modal"
                                        data-fc-target="resetPasswordModal"
                                        onclick="fillResetModal({{ $user->id }}, @js($user->name))"
                                    >
                                        <span class="material-symbols-rounded text-[18px]">lock_reset</span>
                                    </button>

                                    <button
                                        type="button"
                                        title="Delete User"
                                        class="icon-action icon-delete"
                                        data-fc-type="modal"
                                        data-fc-target="deleteUserModal"
                                        onclick="fillDeleteModal({{ $user->id }}, @js($user->name))"
                                    >
                                        <span class="material-symbols-rounded text-[18px]">delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="premium-empty">
                        <span class="material-symbols-rounded">group_off</span>
                        <p class="text-sm font-medium">No users found.</p>
                    </div>
                @endforelse
            </div>

            {{-- DESKTOP TABLE --}}
            <div class="desktop-table-wrap">
                <table class="desktop-table">
                    <colgroup>
                        <col style="width: 26%;">
                        <col style="width: 22%;">
                        <col style="width: 14%;">
                        <col style="width: 18%;">
                        <col style="width: 10%;">
                        <col style="width: 10%;">
                    </colgroup>

                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Subcontractor / Assignment</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="userTableBody">
                        @forelse ($users as $user)
                            @php
                                $avatarColors = ['bg-violet-600','bg-cyan-600','bg-emerald-600','bg-pink-600','bg-orange-500','bg-teal-600','bg-rose-600','bg-indigo-600'];
                                $color = $avatarColors[$user->id % count($avatarColors)];

                                $nameParts = explode(' ', trim($user->name));
                                $initials = strtoupper(
                                    substr($nameParts[0], 0, 1) .
                                    (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : substr($nameParts[0], 1, 1))
                                );

                                $roleLabel = ucfirst(str_replace('_', ' ', $user->role));

                                $roleBadge = match($user->role) {
                                    'admin', 'executives', 'hr', 'project_manager' => ['bg' => '#0F4F36', 'text' => '#DDF5E8'],
                                    'accounting' => ['bg' => '#8A4B08', 'text' => '#FFF1CB'],
                                    'subcon' => ['bg' => '#1E3A8A', 'text' => '#DBEAFE'],
                                    'warehouse' => ['bg' => '#065F46', 'text' => '#D1FAE5'],
                                    'normal_employee' => ['bg' => '#475569', 'text' => '#F8FAFC'],
                                    'visitor' => ['bg' => '#6B7280', 'text' => '#F9FAFB'],
                                    default => ['bg' => '#6B7280', 'text' => '#F9FAFB'],
                                };
                            @endphp

                            <tr
                                class="user-row"
                                data-name="{{ strtolower($user->name) }}"
                                data-email="{{ strtolower($user->email) }}"
                                data-role="{{ strtolower(str_replace('_', ' ', $user->role)) }}"
                                data-subcon="{{ strtolower($user->subcontractor->name ?? '') }}"
                            >
                                <td>
                                    <div class="user-stack">
                                        <div class="avatar-ring {{ $color }}">{{ $initials }}</div>
                                        <div class="min-w-0">
                                            <div class="user-name truncate">{{ $user->name }}</div>
                                            <div class="user-sub">{{ $roleLabel }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="email-text">{{ $user->email }}</span>
                                </td>

                                <td>
                                    <span class="role-badge" style="background: {{ $roleBadge['bg'] }}; color: {{ $roleBadge['text'] }};">
                                        {{ $roleLabel }}
                                    </span>
                                </td>

                                <td>
                                    @if($user->subcontractor)
                                        <div class="leading-tight">
                                            <p class="font-semibold text-gray-700 dark:text-gray-200">{{ $user->subcontractor->name }}</p>
                                            <p class="text-xs text-gray-400 mt-1">{{ ucfirst($user->subcon_role) }}</p>
                                        </div>
                                    @elseif($user->warehouse_id)
                                        <div class="leading-tight">
                                            <p class="font-semibold text-gray-700 dark:text-gray-200">Warehouse Assigned</p>
                                            <p class="text-xs text-gray-400 mt-1">Warehouse ID: {{ $user->warehouse_id }}</p>
                                        </div>
                                    @else
                                        <span class="text-gray-300 dark:text-gray-600">—</span>
                                    @endif
                                </td>

                                <td>
                                    @if($user->is_active)
                                        <span class="status-badge status-active">
                                            <span class="status-dot"></span> Active
                                        </span>
                                    @else
                                        <span class="status-badge status-inactive">
                                            <span class="status-dot"></span> Inactive
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="action-group">
                                        <button
                                            type="button"
                                            title="Edit User"
                                            class="icon-action icon-edit"
                                            data-fc-type="modal"
                                            data-fc-target="editUserModal"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}"
                                            data-user-email="{{ $user->email }}"
                                            data-user-role="{{ $user->role }}"
                                            data-user-subcon-id="{{ $user->subcon_id }}"
                                            data-user-subcon-role="{{ $user->subcon_role }}"
                                            data-user-status="{{ $user->is_active ? '1' : '0' }}"
                                            data-user-warehouse-id="{{ $user->warehouse_id }}"
                                            onclick="fillEditModal(this)"
                                        >
                                            <span class="material-symbols-rounded text-[18px]">edit</span>
                                        </button>

                                        <button
                                            type="button"
                                            title="Reset Password"
                                            class="icon-action icon-reset"
                                            data-fc-type="modal"
                                            data-fc-target="resetPasswordModal"
                                            onclick="fillResetModal({{ $user->id }}, @js($user->name))"
                                        >
                                            <span class="material-symbols-rounded text-[18px]">lock_reset</span>
                                        </button>

                                        <button
                                            type="button"
                                            title="Delete User"
                                            class="icon-action icon-delete"
                                            data-fc-type="modal"
                                            data-fc-target="deleteUserModal"
                                            onclick="fillDeleteModal({{ $user->id }}, @js($user->name))"
                                        >
                                            <span class="material-symbols-rounded text-[18px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="premium-empty">
                                        <span class="material-symbols-rounded">group_off</span>
                                        <p class="text-sm font-medium">No users found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="noSearchResults" class="hidden premium-empty">
                <span class="material-symbols-rounded">manage_search</span>
                <p class="text-sm font-medium">No users match your search.</p>
            </div>

            @if($users->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 dark:border-slate-700 bg-gray-50/70 dark:bg-slate-800/60">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- CREATE USER MODAL --}}
    <div id="createUserModal" class="fc-modal hidden fixed inset-0 z-50 modal-overlay p-3 sm:p-4 flex items-center justify-center">
        <div class="modal-shell sm:max-w-2xl w-full flex flex-col">
            <div class="modal-head flex justify-between items-center py-4 px-5 sm:px-6">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="h-10 w-10 rounded-2xl bg-[var(--brand-soft)] text-[var(--brand)] flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-rounded">person_add</span>
                    </div>
                    <div class="min-w-0">
                        <h3 class="modal-title">Create User Account</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Add a new user with role, status, and assignment mapping.</p>
                    </div>
                </div>
                <button class="inline-flex justify-center items-center h-10 w-10 rounded-2xl hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-slate-700 transition flex-shrink-0" data-fc-dismiss type="button">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-content-scroll px-5 sm:px-6 py-5 sm:py-6 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                    <div>
                        <label class="modal-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Juan dela Cruz" class="ui-field">
                    </div>

                    <div>
                        <label class="modal-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="juan@telcovantage.com" class="ui-field">
                    </div>

                    <div>
                        <label class="modal-label">Password</label>
                        <input type="password" name="password" required class="ui-field">
                    </div>

                    <div>
                        <label class="modal-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" required class="ui-field">
                    </div>

                    <div>
                        <label class="modal-label">Role</label>
                        <select name="role" id="createRoleSelect" required class="ui-select">
                            <option value="">-- Select Role --</option>
                            @foreach (['admin','executives','hr','accounting','project_manager','warehouse','normal_employee','subcon','visitor'] as $role)
                                <option value="{{ $role }}">{{ ucfirst(str_replace('_', ' ', $role)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="modal-label">Status</label>
                        <select name="is_active" class="ui-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div id="createWarehouseField" class="sm:col-span-2 hidden">
                        <label class="modal-label">Assigned Warehouse</label>
                        <select name="warehouse_id" class="ui-select">
                            <option value="">-- Select Warehouse --</option>
                            @foreach ($warehouses as $wh)
                                <option value="{{ $wh->id }}">{{ $wh->name }}{{ $wh->subcontractor ? ' ('.$wh->subcontractor->name.')' : '' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="createSubconFields" class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 hidden">
                        <div>
                            <label class="modal-label">Subcontractor</label>
                            <select name="subcon_id" class="ui-select">
                                <option value="">-- Select Subcon --</option>
                                @foreach ($subcons as $subcon)
                                    <option value="{{ $subcon->id }}">{{ $subcon->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="modal-label">Subcon Role</label>
                            <select name="subcon_role" class="ui-select">
                                <option value="">-- Select --</option>
                                <option value="pm">Project Manager (PM)</option>
                                <option value="lineman">Lineman</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer-stack p-5 border-t border-gray-200 dark:border-slate-700">
                    <button class="premium-cancel" data-fc-dismiss type="button">Cancel</button>
                    <button type="submit" class="primary-btn">Create User</button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT USER MODAL --}}
    <div id="editUserModal" class="fc-modal hidden fixed inset-0 z-50 modal-overlay p-3 sm:p-4 flex items-center justify-center">
        <div class="modal-shell sm:max-w-2xl w-full flex flex-col">
            <div class="modal-head flex justify-between items-center py-4 px-5 sm:px-6">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="h-10 w-10 rounded-2xl bg-[var(--brand-soft)] text-[var(--brand)] flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-rounded">edit</span>
                    </div>
                    <div class="min-w-0">
                        <h3 class="modal-title">Edit User</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Update role, status, password, and assignment details.</p>
                    </div>
                </div>
                <button class="inline-flex justify-center items-center h-10 w-10 rounded-2xl hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-slate-700 transition flex-shrink-0" data-fc-dismiss type="button">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>

            <form method="POST" id="editUserForm" action="">
                @csrf
                @method('PUT')

                <div class="modal-content-scroll px-5 sm:px-6 py-5 sm:py-6 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                    <div>
                        <label class="modal-label">Full Name</label>
                        <input type="text" name="name" id="editName" required class="ui-field">
                    </div>

                    <div>
                        <label class="modal-label">Email Address</label>
                        <input type="email" name="email" id="editEmail" required class="ui-field">
                    </div>

                    <div>
                        <label class="modal-label">New Password</label>
                        <input type="password" name="password" class="ui-field" placeholder="Leave blank to keep current password">
                    </div>

                    <div>
                        <label class="modal-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="ui-field">
                    </div>

                    <div>
                        <label class="modal-label">Role</label>
                        <select name="role" id="editRoleSelect" required class="ui-select">
                            @foreach (['admin','executives','hr','accounting','project_manager','warehouse','normal_employee','subcon','visitor'] as $role)
                                <option value="{{ $role }}">{{ ucfirst(str_replace('_', ' ', $role)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="modal-label">Status</label>
                        <select name="is_active" id="editStatus" class="ui-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div id="editWarehouseField" class="sm:col-span-2 hidden">
                        <label class="modal-label">Assigned Warehouse</label>
                        <select name="warehouse_id" id="editWarehouseId" class="ui-select">
                            <option value="">-- Select Warehouse --</option>
                            @foreach ($warehouses as $wh)
                                <option value="{{ $wh->id }}">{{ $wh->name }}{{ $wh->subcontractor ? ' ('.$wh->subcontractor->name.')' : '' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="editSubconFields" class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 hidden">
                        <div>
                            <label class="modal-label">Subcontractor</label>
                            <select name="subcon_id" id="editSubconId" class="ui-select">
                                <option value="">-- Select Subcon --</option>
                                @foreach ($subcons as $subcon)
                                    <option value="{{ $subcon->id }}">{{ $subcon->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="modal-label">Subcon Role</label>
                            <select name="subcon_role" id="editSubconRole" class="ui-select">
                                <option value="">-- Select --</option>
                                <option value="pm">Project Manager (PM)</option>
                                <option value="lineman">Lineman</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer-stack p-5 border-t border-gray-200 dark:border-slate-700">
                    <button class="premium-cancel" data-fc-dismiss type="button">Cancel</button>
                    <button type="submit" class="primary-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- RESET PASSWORD MODAL --}}
    <div id="resetPasswordModal" class="fc-modal hidden fixed inset-0 z-50 modal-overlay p-3 sm:p-4 flex items-center justify-center">
        <div class="modal-shell sm:max-w-2xl w-full flex flex-col">
            <div class="modal-head flex justify-between items-center py-4 px-5 sm:px-6">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="h-10 w-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-rounded">lock_reset</span>
                    </div>
                    <div class="min-w-0">
                        <h3 class="modal-title">Reset Password</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Generate and assign a secure temporary password.</p>
                    </div>
                </div>
                <button class="inline-flex justify-center items-center h-10 w-10 rounded-2xl hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-slate-700 transition flex-shrink-0" data-fc-dismiss type="button">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>

            <form method="POST" id="resetPasswordForm" action="">
                @csrf
                @method('PATCH')

                <div class="modal-content-scroll px-5 sm:px-6 py-5 sm:py-6 space-y-4">
                    <div class="premium-note-box">
                        <p class="text-sm text-gray-700 dark:text-gray-200">
                            Reset password for <strong id="resetUserName"></strong>. A secure password will be generated below.
                        </p>
                    </div>

                    <div>
                        <label class="modal-label">New Password</label>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input type="text" id="generatedPassword" name="password" readonly class="ui-field font-mono">
                            <div class="flex gap-2">
                                <button type="button" onclick="generatePassword()"
                                    class="h-[50px] w-full sm:w-[50px] rounded-2xl bg-amber-50 text-amber-600 hover:bg-amber-100 transition border border-amber-200 inline-flex items-center justify-center"
                                    title="Generate new password">
                                    <span class="material-symbols-rounded text-[18px]">refresh</span>
                                </button>
                                <button type="button" onclick="copyPassword()"
                                    class="h-[50px] w-full sm:w-[50px] rounded-2xl bg-gray-50 text-gray-600 hover:bg-gray-100 transition border border-gray-200 inline-flex items-center justify-center dark:bg-slate-700 dark:text-gray-200 dark:border-slate-600"
                                    title="Copy password">
                                    <span class="material-symbols-rounded text-[18px]" id="copyIcon">content_copy</span>
                                </button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Copy this and send it to the user after reset.</p>
                    </div>
                </div>

                <div class="modal-footer-stack p-5 border-t border-gray-200 dark:border-slate-700">
                    <button class="premium-cancel" data-fc-dismiss type="button">Cancel</button>
                    <button type="submit" class="warning-btn">Reset Password</button>
                </div>
            </form>
        </div>
    </div>

    {{-- DELETE USER MODAL --}}
    <div id="deleteUserModal" class="fc-modal hidden fixed inset-0 z-50 modal-overlay p-3 sm:p-4 flex items-center justify-center">
        <div class="modal-shell sm:max-w-2xl w-full flex flex-col">
            <div class="modal-head flex justify-between items-center py-4 px-5 sm:px-6">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="h-10 w-10 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-rounded">delete</span>
                    </div>
                    <div class="min-w-0">
                        <h3 class="modal-title">Confirm Delete</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">This action permanently removes the user account.</p>
                    </div>
                </div>
                <button class="inline-flex justify-center items-center h-10 w-10 rounded-2xl hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-slate-700 transition flex-shrink-0" data-fc-dismiss type="button">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>

            <div class="modal-content-scroll px-5 sm:px-6 py-5 sm:py-6">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 h-12 w-12 rounded-2xl bg-red-100 flex items-center justify-center">
                        <span class="material-symbols-rounded text-red-500">warning</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                            Delete <span id="deleteUserName" class="text-red-500"></span>?
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            This action cannot be undone. All associated user access and records tied to this account will be removed.
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal-footer-stack p-5 border-t border-gray-200 dark:border-slate-700">
                <button class="premium-cancel" data-fc-dismiss type="button">Cancel</button>
                <form id="deleteUserForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="danger-btn w-full sm:w-auto">Delete User</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('userSearchInput').addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.user-row');
            const noResults = document.getElementById('noSearchResults');
            const desktopTableBody = document.getElementById('userTableBody');
            const mobileCards = document.getElementById('mobileUserCards');
            let visibleCount = 0;

            rows.forEach(row => {
                const match =
                    row.dataset.name.includes(query) ||
                    row.dataset.email.includes(query) ||
                    row.dataset.role.includes(query) ||
                    (row.dataset.subcon || '').includes(query);

                row.classList.toggle('hidden', !match);
                if (match) visibleCount++;
            });

            const hasAnyRows = rows.length > 0;
            noResults.classList.toggle('hidden', visibleCount > 0 || query === '' || !hasAnyRows);

            if (desktopTableBody) {
                desktopTableBody.classList.toggle('hidden', visibleCount === 0 && query !== '' && hasAnyRows);
            }

            if (mobileCards) {
                mobileCards.classList.toggle('hidden', visibleCount === 0 && query !== '' && hasAnyRows);
            }

            document.getElementById('searchResultCount').textContent =
                query ? `${visibleCount} result${visibleCount !== 1 ? 's' : ''}` : `{{ $users->total() }} users`;
        });

        function toggleCreateFields(role) {
            document.getElementById('createSubconFields').classList.toggle('hidden', role !== 'subcon');
            document.getElementById('createWarehouseField').classList.toggle('hidden', role !== 'warehouse');
        }

        function toggleEditFields(role) {
            document.getElementById('editSubconFields').classList.toggle('hidden', role !== 'subcon');
            document.getElementById('editWarehouseField').classList.toggle('hidden', role !== 'warehouse');
        }

        document.getElementById('createRoleSelect').addEventListener('change', function () {
            toggleCreateFields(this.value);
        });

        document.getElementById('editRoleSelect').addEventListener('change', function () {
            toggleEditFields(this.value);
        });

        function fillEditModal(button) {
            const id = button.dataset.userId;
            const name = button.dataset.userName || '';
            const email = button.dataset.userEmail || '';
            const role = button.dataset.userRole || '';
            const subconId = button.dataset.userSubconId || '';
            const subconRole = button.dataset.userSubconRole || '';
            const status = button.dataset.userStatus || '1';
            const warehouseId = button.dataset.userWarehouseId || '';

            document.getElementById('editUserForm').action = `/admin/users/${id}`;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRoleSelect').value = role;
            document.getElementById('editStatus').value = status;
            document.getElementById('editSubconId').value = subconId;
            document.getElementById('editSubconRole').value = subconRole;
            document.getElementById('editWarehouseId').value = warehouseId;

            toggleEditFields(role);
        }

        function fillResetModal(id, name) {
            document.getElementById('resetPasswordForm').action = `/admin/users/${id}/reset-password`;
            document.getElementById('resetUserName').textContent = name;
            generatePassword();
        }

        function generatePassword() {
            const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789@#$!';
            let password = '';
            for (let i = 0; i < 12; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('generatedPassword').value = password;
        }

        function copyPassword() {
            const pw = document.getElementById('generatedPassword').value;
            navigator.clipboard.writeText(pw).then(() => {
                const icon = document.getElementById('copyIcon');
                icon.textContent = 'check';
                setTimeout(() => icon.textContent = 'content_copy', 1800);
            });
        }

        function fillDeleteModal(id, name) {
            document.getElementById('deleteUserForm').action = `/admin/users/${id}`;
            document.getElementById('deleteUserName').textContent = name;
        }
    </script>
    @endpush
</x-layout>