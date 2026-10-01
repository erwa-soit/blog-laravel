<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div
                        class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                        W
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <x-my-nav-link href="/" :current="request()->is('/')">Home</x-my-nav-link>
                        <x-my-nav-link href="/posts" :current="request()->is('posts')">Blog</x-my-nav-link>
                        <x-my-nav-link href="/about" :current="request()->is('about')">About</x-my-nav-link>
                        <x-my-nav-link href="/contact" :current="request()->is('contact')">Contact</x-my-nav-link>

                    </div>
                </div>
            </div>

            <!-- Sisi Kanan: Notifikasi & Profile Dropdown (Desktop) -->
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">

                    <!-- Dropdown Profil dengan Alpine.js -->
                    <div class="relative ml-3" x-data="{ isOpen: false }">
                        @if (Auth::check())
                            <!-- Tombol Foto Profil -->
                            <button type="button" @click="isOpen = !isOpen"
                                class="flex max-w-xs items-center rounded-full bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-slate-900 cursor-pointer"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="User avatar">
                                <div class="text-gray-300 text-sm font-medium ml-3">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="ms-1 text-gray-300">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @else
                            <a href="/login" class="text-white text-sm font-medium">Login</a>
                            <span class="text-white font-medium">|</span>
                            <a href="/register" class="text-white text-sm font-medium">Register</a>
                        @endif
                        <!-- Menu Pop-up Dropdown Desktop -->
                        <div x-show="isOpen" @click.away="isOpen = false" x-cloak
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">

                            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem" tabindex="-1">Your Profile</a>
                            <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem" tabindex="-1">Settings</a>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                    role="menuitem" tabindex="-1">Log out</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Tombol Hamburger (Hanya Tampil di Mobile) -->
            <div class="-mr-2 flex md:hidden">
                <button type="button" @click="isOpenMobile = !isOpenMobile"
                    class="relative inline-flex items-center justify-center rounded-md bg-slate-900 p-2 text-gray-400 hover:bg-slate-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-slate-900"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>

                    <!-- Icon Hamburger saat tertutup -->
                    <svg x-show="!isOpenMobile" class="block h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <!-- Icon Silang (X) saat terbuka -->
                    <svg x-show="isOpenMobile" class="block h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div x-show="isOpenMobile" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <x-my-nav-link class="block" href="/" :current="request()->is('/')">Home</x-my-nav-link>
            <x-my-nav-link class="block" href="/posts" :current="request()->is('posts')">Blog</x-my-nav-link>
            <x-my-nav-link class="block" href="/about" :current="request()->is('about')">About</x-my-nav-link>
            <x-my-nav-link class="block" href="/contact" :current="request()->is('contact')">Contact</x-my-nav-link>
        </div>

        <!-- Bagian Profil User di Mobile -->
        <div class="border-t border-gray-700 pb-3 pt-4">
            @if (Auth::check())
                <div class="flex items-center px-5">
                    <div class="shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a href="/profile"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-slate-700 hover:text-white">Your
                        Profile</a>
                    <a href="/dashboard"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-slate-700 hover:text-white">Settings</a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit"
                            class="block w-full text-start rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-slate-700 hover:text-white cursor-pointer"
                            role="menuitem" tabindex="-1">Log out</button>
                    </form>
                </div>
            @else
                <div class="my-3 space-y-1 px-2">
                    <a href="/login" class="block text-white text-sm font-medium py-2">Login</a>
                    <a href="/register" class="block text-white text-sm font-medium py-2">Register</a>
                </div>
            @endif
        </div>
    </div>
</nav>
