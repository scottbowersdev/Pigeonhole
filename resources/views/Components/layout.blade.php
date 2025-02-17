<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100 dark:bg-slate-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $meta_title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
</head>

<body class="h-full">

    <div class="min-h-full">
        <nav class="bg-gray-800 dark:bg-black">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <a href="/">
                                <x-logo />
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <x-nav href="/" :active="request()->is('/')">Dashboard</x-nav>
                                <x-nav href="/wishlist" :active="request()->is('wishlist')">Wishlist</x-nav>
                                <x-nav href="/recurring-outgoings" :active="request()->is('recurring-outgoings')">Recurring Outgoings</x-nav>
                                <x-nav href="/categories" :active="request()->is('categories')">Categories</x-nav>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">

                            <!-- Profile dropdown -->
                            <div class="relative ml-3">
                                <div>
                                    @guest
                                    <x-nav href="/login" :active="request()->is('login')">Login</x-nav>
                                    <x-nav href="/register" :active="request()->is('register')">Register</x-nav>
                                    @endguest

                                    @auth
                                    <x-nav href="/profile" :active="request()->is('profile')">{{ Auth::user()->first_name.' '.Auth::user()->surname }}</x-nav>
                                    <form method="POST" action="/logout" class="inline">
                                        @csrf
                                        <x-form.button>Logout</x-form.button>
                                    </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" onClick="showMobileMenu()" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
                            <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <x-nav href="/" :active="request()->is('/')" :mobile="true">Dashboard</x-nav>
                    <x-nav href="/wishlist" :active="request()->is('/wishlist')" :mobile="true">Wishlist</x-nav>
                    <x-nav href="/recurring-outgoings" :active="request()->is('/recurring-outgoings')" :mobile="true">Recurring Outgoings</x-nav>
                    <x-nav href="/categories" :active="request()->is('/categories')" :mobile="true">Categories</x-nav>
                </div>
                <div class="border-t border-gray-700 pb-3 pt-4">
                    <div class="flex items-center px-5">
                        <div class="">
                            <div class="text-base/5 font-medium text-white mb-5"><a href="/profile" :active="request()->is('profile')">{{ Auth::user()->first_name.' '.Auth::user()->surname }}</a></div>
                            <form method="POST" action="/logout" class="inline">
                                @csrf
                                <x-form.button>Logout</x-form.button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-white dark:bg-slate-950 shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100">{{ $page_title }}</h1>
                <div>{{ $buttons }}</div>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    <div class="fixed bottom-2 right-2 bg-white dark:bg-black w-8 h-8 shrink-0 grow-0 rounded-full shadow">
        <div class="flex flex-col justify-center">
            <input type="checkbox" name="light-switch" id="light-switch" class="light-switch sr-only" />
            <label class="relative cursor-pointer p-2" for="light-switch">
                <svg class="hidden dark:block" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-slate-200" d="M7 0h2v2H7zM12.88 1.637l1.414 1.415-1.415 1.413-1.413-1.414zM14 7h2v2h-2zM12.95 14.433l-1.414-1.413 1.413-1.415 1.415 1.414zM7 14h2v2H7zM2.98 14.364l-1.413-1.415 1.414-1.414 1.414 1.415zM0 7h2v2H0zM3.05 1.706 4.463 3.12 3.05 4.535 1.636 3.12z" />
                    <path class="fill-slate-200" d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4Z" />
                </svg>
                <svg class="dark:hidden" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-slate-600" d="M6.2 1C3.2 1.8 1 4.6 1 7.9 1 11.8 4.2 15 8.1 15c3.3 0 6-2.2 6.9-5.2C9.7 11.2 4.8 6.3 6.2 1Z" />
                    <path class="fill-slate-600" d="M12.5 5a.625.625 0 0 1-.625-.625 1.252 1.252 0 0 0-1.25-1.25.625.625 0 1 1 0-1.25 1.252 1.252 0 0 0 1.25-1.25.625.625 0 1 1 1.25 0c.001.69.56 1.249 1.25 1.25a.625.625 0 1 1 0 1.25c-.69.001-1.249.56-1.25 1.25A.625.625 0 0 1 12.5 5Z" />
                </svg>
                <span class="sr-only">Switch to light / dark version</span>
            </label>
        </div>
    </div>

</body>

</html>