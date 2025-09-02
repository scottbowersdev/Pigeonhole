<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100 dark:bg-slate-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Pigeonhole" />
    <link rel="manifest" href="/site.webmanifest" />
    <title>{{ $meta_title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
</head>

<body class="h-full">

    <div class="min-h-full">
        <nav class="fixed bottom-0 left-0 z-50 w-full h-16 border-t bg-gray-900 border-gray-800">
            <div class="grid h-full max-w-lg grid-cols-6 mx-auto font-xs">
                <x-nav href="/" :active="request()->is('/')">Dashboard</x-nav>
                <x-nav href="/wishlist" :active="request()->is('wishlist')">Wishlist</x-nav>
                <x-nav href="/recurring-outgoings" :active="request()->is('recurring-outgoings')">Recurring</x-nav>
                <x-nav href="/categories" :active="request()->is('categories')">Categories</x-nav>
                @auth
                    <x-nav href="/profile" :active="request()->is('profile')">Profile</x-nav>

                    <x-nav href="/logout" :active="request()->is('logout')">Logout</x-nav>
                @endauth
            </div>
        </nav>

        <header class="bg-white dark:bg-slate-950 shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between">
                <h1
                    class="flex items-center gap-2 text-2xl sm:text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100">
                    <a href="/" class="shrink-0 mr-2">
                        <x-logo class="h-8 w-8" />
                    </a>
                    <span>{{ $page_title }}</span>
                </h1>
                <div>{{ $buttons }}</div>
            </div>
        </header>
        <main class="pb-20">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>

</html>
