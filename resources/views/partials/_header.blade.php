
  <header class="app-header flex items-center px-4 gap-3">
                <!-- Sidenav Menu Toggle Button -->
                <button id="button-toggle-menu" class="nav-link p-2">
                    <span class="sr-only">Menu Toggle Button</span>
                    <span class="flex items-center justify-center h-6 w-6">
                        <i class="mgc_menu_line text-xl"></i>
                    </span>
                </button>

                <!-- Topbar Brand Logo -->
                <a href="index.html" class="logo-box">
                    <!-- Light Brand Logo -->
                    <div class="logo-light">
                        <img src="assets/images/logo-light.png" class="logo-lg h-6" alt="Light logo">
                        <img src="assets/images/logo-sm.png" class="logo-sm" alt="Small logo">
                    </div>

                    <!-- Dark Brand Logo -->
                    <div class="logo-dark">
                        <img src="assets/images/logo-dark.png" class="logo-lg h-6" alt="Dark logo">
                        <img src="assets/images/logo-sm.png" class="logo-sm" alt="Small logo">
                    </div>
                </a>

                <!-- Topbar Search Modal Button -->
                <button type="button" data-fc-type="modal" data-fc-target="topbar-search-modal" class="nav-link p-2 me-auto">
                    <span class="sr-only">Search</span>
                    <span class="flex items-center justify-center h-6 w-6">
                        <i class="mgc_search_line text-2xl"></i>
                    </span>
                </button>

                <!-- Language Dropdown Button -->
               

                <!-- Fullscreen Toggle Button -->
                <div class="md:flex hidden">
                    <button data-toggle="fullscreen" type="button" class="nav-link p-2">
                        <span class="sr-only">Fullscreen Mode</span>
                        <span class="flex items-center justify-center h-6 w-6">
                            <i class="mgc_fullscreen_line text-2xl"></i>
                        </span>
                    </button>
                </div>

                <!-- Notification Bell Button -->
                <div class="relative md:flex hidden">
                    <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link p-2">
                        <span class="sr-only">View notifications</span>
                        <span class="flex items-center justify-center h-6 w-6">
                            <i class="mgc_notification_line text-2xl"></i>
                        </span>
                    </button>
                    <div class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-80 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg">

                        <div class="p-2 border-b border-dashed border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h6 class="text-sm"> Notification</h6>
                                <a href="javascript: void(0);" class="text-gray-500 underline">
                                    <small>Clear All</small>
                                </a>
                            </div>
                        </div>

                        <div class="p-4 h-80" data-simplebar>

                            <h5 class="text-xs text-gray-500 mb-2">Today</h5>

                            <a href="javascript:void(0);" class="block mb-4">
                                <div class="card-body">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg text-white bg-primary">
                                                <i class="mgc_message_3_line text-lg"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow truncate ms-2">
                                            <h5 class="text-sm font-semibold mb-1">Datacorp <small class="font-normal text-gray-500 ms-1">1 min ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript:void(0);" class="block mb-4">
                                <div class="card-body">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-info text-white">
                                                <i class="mgc_user_add_line text-lg"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow truncate ms-2">
                                            <h5 class="text-sm font-semibold mb-1">Admin <small class="font-normal text-gray-500 ms-1">1 hr ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">New user registered</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript:void(0);" class="block mb-4">
                                <div class="card-body">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-2.jpg" class="rounded-full h-9 w-9" alt="">
                                        </div>
                                        <div class="flex-grow truncate ms-2">
                                            <h5 class="text-sm font-semibold mb-1">Cristina Pride <small class="font-normal text-gray-500 ms-1">1 day ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <h5 class="text-xs text-gray-500 mb-2">Yesterday</h5>

                            <a href="javascript:void(0);" class="block mb-4">
                                <div class="card-body">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-primary text-white">
                                                <i class="mgc_message_1_line text-lg"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow truncate ms-2">
                                            <h5 class="text-sm font-semibold mb-1">Datacorp</h5>
                                            <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript:void(0);" class="block">
                                <div class="card-body">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-4.jpg" class="rounded-full h-9 w-9" alt="">
                                        </div>
                                        <div class="flex-grow truncate ms-2">
                                            <h5 class="text-sm font-semibold mb-1">Karen Robinson</h5>
                                            <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <a href="javascript:void(0);" class="p-2 border-t border-dashed border-gray-200 dark:border-gray-700 block text-center text-primary underline font-semibold">
                            View All
                        </a>
                    </div>
                </div>

                <!-- Light/Dark Toggle Button -->
                <div class="flex">
                    <button id="light-dark-mode" type="button" class="nav-link p-2">
                        <span class="sr-only">Light/Dark Mode</span>
                        <span class="flex items-center justify-center h-6 w-6">
                            <i class="mgc_moon_line text-2xl"></i>
                        </span>
                    </button>
                </div>

                <!-- Profile Dropdown Button -->
                <div class="relative">
                    @php
                        $authUser   = auth()->user();
                        $nameParts  = explode(' ', trim($authUser->name ?? ''));
                        $initials   = strtoupper(
                            substr($nameParts[0] ?? '', 0, 1) .
                            substr(end($nameParts) !== $nameParts[0] ? end($nameParts) : '', 0, 1)
                        );
                    @endphp
                    <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link p-0">
                        <div class="flex items-center justify-center h-10 w-10 rounded-full text-white font-bold text-sm select-none"
                             style="background-color: #00754A;">
                            {{ $initials }}
                        </div>
                    </button>
                    <div class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-52 z-50 transition-[margin,opacity] duration-300 mt-2 bg-white shadow-lg border rounded-lg p-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex items-center gap-2 px-3 py-2 mb-1">
                            <div class="flex items-center justify-center h-8 w-8 rounded-full text-white font-bold text-xs flex-shrink-0"
                                 style="background-color: #00754A;">
                                {{ $initials }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate">{{ $authUser->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 capitalize truncate">{{ str_replace('_', ' ', $authUser->role) }}</p>
                            </div>
                        </div>
                        <hr class="my-1 -mx-2 border-gray-200 dark:border-gray-700">
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="{{ route('profile.edit') }}">
                            <i class="mgc_pic_2_line me-2"></i>
                            <span>Profile</span>
                        </a>
                        <hr class="my-1 -mx-2 border-gray-200 dark:border-gray-700">

                  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" 
        class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 w-full text-left">
        <i class="mgc_exit_line me-2"></i>
        <span>Log Out</span>
    </button>
</form>
                        
                    </div>
                </div>
            </header>