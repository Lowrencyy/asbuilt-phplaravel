
<x-layout>

    {{-- ===================== FLASH MESSAGE ===================== --}}
    @if (session('success'))
        <div class="col-span-full">
            <div class="flex items-center gap-3 p-4 mb-2 rounded-lg bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
                <span class="material-symbols-rounded text-green-500">check_circle</span>
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- ===================== HEADER ROW ===================== --}}
    <div class="col-span-full flex items-center justify-between mb-4">
        <div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-100">User Management</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage all system users, roles, and access.</p>
        </div>
        <button class="btn bg-primary text-black flex items-center gap-2 px-4 py-2 rounded-lg shadow-sm hover:opacity-90 transition"
            data-fc-type="modal" data-fc-target="createUserModal" type="button">
            <span class="material-symbols-rounded text-base">person_add</span>
            Add User
        </button>
    </div>

    {{-- ===================== TABLE CARD ===================== --}}
    <div class="col-span-full card p-0 overflow-hidden rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm">

        {{-- Search Bar --}}
        <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center gap-3">
            <div class="relative flex-1 max-w-sm">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-rounded text-gray-400 text-base">search</span>
                <input
                    type="text"
                    id="userSearchInput"
                    placeholder="Search by name, email, or role..."
                    class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                >
            </div>
            <span class="text-xs text-gray-400" id="searchResultCount">{{ $users->total() }} users</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700 bg-gray-50/60 dark:bg-slate-700/40">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subcon</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody" class="bg-white dark:bg-slate-800 divide-y divide-gray-50 dark:divide-gray-700/50">
                    @forelse ($users as $user)
                        @php
                            // ✅ Avatar color
                            $avatarColors = ['bg-violet-500','bg-cyan-500','bg-emerald-500','bg-pink-500','bg-orange-500','bg-teal-500','bg-rose-500','bg-indigo-500'];
                            $color = $avatarColors[$user->id % count($avatarColors)];

                            // ✅ Proper initials — first letter of first name + first letter of last name
                            $nameParts = explode(' ', trim($user->name));
                            $initials = strtoupper(
                                substr($nameParts[0], 0, 1) .
                                (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : substr($nameParts[0], 1, 1))
                            );

                            // ✅ Role badge colors
                            $roleBadge = match($user->role) {
                                'admin'           => ['bg' => '#1E3932', 'text' => '#D4E9E2'],
                                'executives'      => ['bg' => '#1E3932', 'text' => '#D4E9E2'],
                                'hr'              => ['bg' => '#1E3932', 'text' => '#D4E9E2'],
                                'project_manager' => ['bg' => '#1E3932', 'text' => '#D4E9E2'],
                                'accounting'      => ['bg' => '#92400E', 'text' => '#FEF3C7'],
                                'subcon'          => ['bg' => '#1E40AF', 'text' => '#DBEAFE'],
                                'normal_employee' => ['bg' => '#374151', 'text' => '#F3F4F6'],
                                'visitor'         => ['bg' => '#6B7280', 'text' => '#F9FAFB'],
                                default           => ['bg' => '#6B7280', 'text' => '#F9FAFB'],
                            };
                        @endphp
                        <tr class="user-row hover:bg-gray-50/70 dark:hover:bg-slate-700/30 transition-colors"
                            data-name="{{ strtolower($user->name) }}"
                            data-email="{{ strtolower($user->email) }}"
                            data-role="{{ strtolower(str_replace('_', ' ', $user->role)) }}">

                            {{-- Avatar + Name --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full {{ $color }} flex items-center justify-center text-black text-sm font-bold flex-shrink-0 shadow-sm">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 dark:text-gray-100 leading-tight">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-300">{{ $user->email }}</td>

                            {{-- Role Badge ✅ whitespace-nowrap fixes truncation --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center whitespace-nowrap px-3 py-1 rounded-full text-xs font-semibold"
                                    style="background-color: {{ $roleBadge['bg'] }}; color: {{ $roleBadge['text'] }}">
                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                </span>
                            </td>

                            {{-- Subcon --}}
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-300">
                                @if($user->subcontractor)
                                    <div class="leading-tight">
                                        <p class="font-medium text-gray-700 dark:text-gray-200">{{ $user->subcontractor->name }}</p>
                                        <p class="text-xs text-gray-400">{{ ucfirst($user->subcon_role) }}</p>
                                    </div>
                                @else
                                    <span class="text-gray-300 dark:text-gray-600">—</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span> Inactive
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-1.5">
                                    {{-- Edit --}}
                                    <button type="button" title="Edit User"
                                        class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition"
                                        data-fc-type="modal" data-fc-target="editUserModal"
                                        onclick="fillEditModal({{ $user->id }},'{{ addslashes($user->name) }}','{{ $user->email }}','{{ $user->role }}','{{ $user->subcon_id }}','{{ $user->subcon_role }}',{{ $user->is_active ? 'true' : 'false' }})">
                                        <span class="material-symbols-rounded text-base">edit</span>
                                    </button>

                                    {{-- Reset Password --}}
                                    <button type="button" title="Reset Password"
                                        class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition"
                                        data-fc-type="modal" data-fc-target="resetPasswordModal"
                                        onclick="fillResetModal({{ $user->id }}, '{{ addslashes($user->name) }}')">
                                        <span class="material-symbols-rounded text-base">lock_reset</span>
                                    </button>

                                    {{-- Delete --}}
                                    <button type="button" title="Delete User"
                                        class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition"
                                        data-fc-type="modal" data-fc-target="deleteUserModal"
                                        onclick="fillDeleteModal({{ $user->id }}, '{{ addslashes($user->name) }}')">
                                        <span class="material-symbols-rounded text-base">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-2 text-gray-400">
                                    <span class="material-symbols-rounded text-4xl">group_off</span>
                                    <p class="text-sm">No users found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- No search results message --}}
            <div id="noSearchResults" class="hidden px-6 py-16 text-center">
                <div class="flex flex-col items-center gap-2 text-gray-400">
                    <span class="material-symbols-rounded text-4xl">manage_search</span>
                    <p class="text-sm">No users match your search.</p>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="px-6 py-3 border-t border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-slate-700/20">
                {{ $users->links() }}
            </div>
        @endif
    </div>


    {{-- ============================================================ --}}
    {{-- CREATE USER MODAL                                            --}}
    {{-- ============================================================ --}}
    <div id="createUserModal" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
        <div class="sm:max-w-2xl fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-800 dark:border-gray-700">
            <div class="flex justify-between items-center py-3 px-5 border-b dark:border-gray-700">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-rounded text-primary">person_add</span>
                    <h3 class="font-semibold text-gray-800 dark:text-black text-base">Create User Account</h3>
                </div>
                <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-lg hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-slate-700 transition" data-fc-dismiss type="button">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="px-5 py-5 overflow-y-auto grid grid-cols-2 gap-4">

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Juan dela Cruz"
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="juan@telcovantage.com"
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Password</label>
                        <input type="password" name="password" required
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Role</label>
                        <select name="role" id="createRoleSelect" required
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                            <option value="">-- Select Role --</option>
                            @foreach (['admin','executives','hr','accounting','project_manager','normal_employee','subcon','visitor'] as $role)
                                <option value="{{ $role }}">{{ ucfirst(str_replace('_', ' ', $role)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Status</label>
                        <select name="is_active"
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div id="createSubconFields" class="col-span-2 grid grid-cols-2 gap-4 hidden">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Subcontractor</label>
                            <select name="subcon_id"
                                class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                                <option value="">-- Select Subcon --</option>
                                @foreach ($subcons as $subcon)
                                    <option value="{{ $subcon->id }}">{{ $subcon->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Subcon Role</label>
                            <select name="subcon_role"
                                class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                                <option value="">-- Select --</option>
                                <option value="pm">Project Manager (PM)</option>
                                <option value="lineman">Lineman</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="flex justify-end items-center gap-3 p-4 border-t dark:border-slate-700">
                    <button class="btn border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 rounded-lg px-4 py-2 text-sm transition" data-fc-dismiss type="button">Cancel</button>
                    <button type="submit" class="btn bg-primary text-black rounded-lg px-4 py-2 text-sm hover:opacity-90 transition">Create User</button>
                </div>
            </form>
        </div>
    </div>


    {{-- ============================================================ --}}
    {{-- EDIT USER MODAL                                              --}}
    {{-- ============================================================ --}}
    <div id="editUserModal" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
        <div class="sm:max-w-2xl fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-800 dark:border-gray-700">
            <div class="flex justify-between items-center py-3 px-5 border-b dark:border-gray-700">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-rounded text-blue-500">edit</span>
                    <h3 class="font-semibold text-gray-800 dark:text-black text-base">Edit User</h3>
                </div>
                <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-lg hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-slate-700 transition" data-fc-dismiss type="button">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            <form method="POST" id="editUserForm" action="">
                @csrf
                @method('PUT')
                <div class="px-5 py-5 overflow-y-auto grid grid-cols-2 gap-4">

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Full Name</label>
                        <input type="text" name="name" id="editName" required
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Email Address</label>
                        <input type="email" name="email" id="editEmail" required
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">
                            New Password <span class="text-gray-400 normal-case font-normal">(leave blank to keep)</span>
                        </label>
                        <input type="password" name="password"
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Role</label>
                        <select name="role" id="editRoleSelect" required
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                            @foreach (['admin','executives','hr','accounting','project_manager','normal_employee','subcon','visitor'] as $role)
                                <option value="{{ $role }}">{{ ucfirst(str_replace('_', ' ', $role)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Status</label>
                        <select name="is_active" id="editStatus"
                            class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div id="editSubconFields" class="col-span-2 grid grid-cols-2 gap-4 hidden">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Subcontractor</label>
                            <select name="subcon_id" id="editSubconId"
                                class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                                <option value="">-- Select Subcon --</option>
                                @foreach ($subcons as $subcon)
                                    <option value="{{ $subcon->id }}">{{ $subcon->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Subcon Role</label>
                            <select name="subcon_role" id="editSubconRole"
                                class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-white dark:bg-slate-700 dark:text-black focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                                <option value="">-- Select --</option>
                                <option value="pm">Project Manager (PM)</option>
                                <option value="lineman">Lineman</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="flex justify-end items-center gap-3 p-4 border-t dark:border-slate-700">
                    <button class="btn border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 rounded-lg px-4 py-2 text-sm transition" data-fc-dismiss type="button">Cancel</button>
                    <button type="submit" class="btn bg-blue-500 text-black rounded-lg px-4 py-2 text-sm hover:bg-blue-600 transition">Save Changes</button>
                </div>
            </form>
        </div>
    </div>


    {{-- ============================================================ --}}
    {{-- RESET PASSWORD MODAL                                         --}}
    {{-- ============================================================ --}}
    <div id="resetPasswordModal" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
        <div class="sm:max-w-md fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-800 dark:border-gray-700">
            <div class="flex justify-between items-center py-3 px-5 border-b dark:border-gray-700">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-rounded text-amber-500">lock_reset</span>
                    <h3 class="font-semibold text-gray-800 dark:text-black text-base">Reset Password</h3>
                </div>
                <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-lg hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-slate-700 transition" data-fc-dismiss type="button">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            <form method="POST" id="resetPasswordForm" action="">
                @csrf
                @method('PATCH')
                <div class="px-5 py-5 space-y-4">
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Reset password for <strong id="resetUserName" class="text-gray-800 dark:text-black"></strong>.
                        A random password will be generated.
                    </p>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">New Password</label>
                        <div class="flex gap-2">
                            <input type="text" id="generatedPassword" name="password" readonly
                                class="w-full border border-gray-200 dark:border-gray-600 rounded-lg px-3 py-2.5 text-sm bg-gray-50 dark:bg-slate-700 dark:text-black font-mono focus:outline-none">
                            <button type="button" onclick="generatePassword()"
                                class="flex-shrink-0 inline-flex items-center justify-center h-10 w-10 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition border border-amber-200"
                                title="Generate new password">
                                <span class="material-symbols-rounded text-base">refresh</span>
                            </button>
                            <button type="button" onclick="copyPassword()"
                                class="flex-shrink-0 inline-flex items-center justify-center h-10 w-10 rounded-lg bg-gray-50 text-gray-600 hover:bg-gray-100 transition border border-gray-200"
                                title="Copy password">
                                <span class="material-symbols-rounded text-base" id="copyIcon">content_copy</span>
                            </button>
                        </div>
                        <p class="text-xs text-gray-400 mt-1.5">Make sure to copy and share this password with the user.</p>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-3 p-4 border-t dark:border-slate-700">
                    <button class="btn border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 rounded-lg px-4 py-2 text-sm transition" data-fc-dismiss type="button">Cancel</button>
                    <button type="submit" class="btn bg-amber-500 text-black rounded-lg px-4 py-2 text-sm hover:bg-amber-600 transition">Reset Password</button>
                </div>
            </form>
        </div>
    </div>


    {{-- ============================================================ --}}
    {{-- DELETE USER MODAL                                            --}}
    {{-- ============================================================ --}}
    <div id="deleteUserModal" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
        <div class="sm:max-w-md fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-800 dark:border-gray-700">
            <div class="flex justify-between items-center py-3 px-5 border-b dark:border-gray-700">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-rounded text-red-500">delete</span>
                    <h3 class="font-semibold text-gray-800 dark:text-black text-base">Confirm Delete</h3>
                </div>
                <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-lg hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-slate-700 transition" data-fc-dismiss type="button">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            <div class="px-5 py-5">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                        <span class="material-symbols-rounded text-red-500">warning</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-100">Delete <span id="deleteUserName" class="text-red-500"></span>?</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">This action is permanent and cannot be undone. All data associated with this user will be removed.</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end items-center gap-3 p-4 border-t dark:border-slate-700">
                <button class="btn border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 rounded-lg px-4 py-2 text-sm transition" data-fc-dismiss type="button">Cancel</button>
                <form id="deleteUserForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-red-500 text-black rounded-lg px-4 py-2 text-sm hover:bg-red-600 transition">Delete this user</button>
                </form>
            </div>
        </div>
    </div>


    {{-- ============================================================ --}}
    {{-- JAVASCRIPT                                                   --}}
    {{-- ============================================================ --}}
    @push('scripts')
    <script>
        // ---- Live Search ----
        document.getElementById('userSearchInput').addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.user-row');
            const noResults = document.getElementById('noSearchResults');
            let visibleCount = 0;

            rows.forEach(row => {
                const match = row.dataset.name.includes(query)
                           || row.dataset.email.includes(query)
                           || row.dataset.role.includes(query);
                row.classList.toggle('hidden', !match);
                if (match) visibleCount++;
            });

            noResults.classList.toggle('hidden', visibleCount > 0 || query === '');
            document.getElementById('searchResultCount').textContent =
                query ? `${visibleCount} result${visibleCount !== 1 ? 's' : ''}` : `{{ $users->total() }} users`;
        });

        // ---- Create modal: show/hide subcon fields ----
        document.getElementById('createRoleSelect').addEventListener('change', function () {
            document.getElementById('createSubconFields').classList.toggle('hidden', this.value !== 'subcon');
        });

        // ---- Edit modal ----
        function fillEditModal(id, name, email, role, subconId, subconRole, isActive) {
            document.getElementById('editUserForm').action = `/admin/users/${id}`;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editStatus').value = isActive ? '1' : '0';
            document.getElementById('editRoleSelect').value = role;
            toggleEditSubcon(role);
            document.getElementById('editSubconId').value = subconId || '';
            document.getElementById('editSubconRole').value = subconRole || '';
        }

        document.getElementById('editRoleSelect').addEventListener('change', function () {
            toggleEditSubcon(this.value);
        });

        function toggleEditSubcon(role) {
            document.getElementById('editSubconFields').classList.toggle('hidden', role !== 'subcon');
        }

        // ---- Reset Password modal ----
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
                setTimeout(() => icon.textContent = 'content_copy', 2000);
            });
        }

        // ---- Delete modal ----
        function fillDeleteModal(id, name) {
            document.getElementById('deleteUserForm').action = `/admin/users/${id}`;
            document.getElementById('deleteUserName').textContent = name;
        }
    </script>
    @endpush

</x-layout>