<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $meta_title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
</head>

<body class="h-full">

    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <a href="/">
                                <svg class="w-8" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 511.976 511.976" xml:space="preserve">
                                    <path style="fill:#AAB2BC;" d="M490.649,85.101c-5.891,0-10.671-4.78-10.671-10.655V63.774c0-5.89,4.78-10.671,10.671-10.671
	s10.655,4.781,10.655,10.671v10.672C501.304,80.321,496.54,85.101,490.649,85.101z" />
                                    <path style="fill:#F6BB42;" d="M287.986,490.639c-5.891,0-10.672-4.78-10.672-10.655V437.33c0-5.906,4.781-10.687,10.672-10.687
	s10.672,4.78,10.672,10.687v42.654C298.658,485.859,293.877,490.639,287.986,490.639z" />
                                    <path style="fill:#FFCE54;" d="M330.655,490.639h-63.996c-5.891,0-10.671-4.78-10.671-10.655c0-5.906,4.781-10.656,10.671-10.656
	h63.996c5.891,0,10.656,4.75,10.656,10.656C341.311,485.859,336.546,490.639,330.655,490.639z" />
                                    <path style="fill:#CCD1D9;" d="M501.304,85.101h-45.81c-5.891,0-10.656-4.78-10.656-10.655c0-5.906,4.766-10.672,10.656-10.672
	h45.81c5.891,0,10.672,4.766,10.672,10.672C511.976,80.321,507.195,85.101,501.304,85.101z" />
                                    <path style="fill:#434A54;" d="M287.986,320.272c-23.522,0-42.662,19.155-42.662,42.686c0,11.062,4.195,30.999,9.984,47.342
	c8.96,25.374,19.647,37.687,32.678,37.687s23.718-12.312,32.687-37.687c5.78-16.343,9.982-36.28,9.982-47.342
	C330.655,339.427,311.516,320.272,287.986,320.272z" />
                                    <g>
                                        <path style="fill:#656D78;" d="M478.259,58.9c1.891-2.906,2.234-6.531,0.953-9.75c-0.453-1.141-11.5-27.812-47.154-27.812
		c-3.938,0-8.077,0.344-12.312,1.016c-25.734,4.094-41.608,37.14-59.982,75.419c-13.953,29.046-28.375,59.091-46.857,75.45
		c-11.89,10.53-47.045,32.42-147.064,76.95c-60.404,26.882-116.245,49.35-116.8,49.6c-4.086,1.625-6.75,5.625-6.688,10.031
		s2.828,8.312,6.969,9.843c96.418,35.686,177.891,53.779,242.162,53.779h0.016c67.263,0,117.292-19.656,148.681-58.466
		c40.187-49.663,49.154-129.863,26.655-238.421L478.259,58.9z" />
                                        <path style="fill:#656D78;" d="M247.777,349.583l-149.33-35.247c-2.625-0.594-5.382-0.219-7.726,1.125l-85.332,48.59
		c-4.305,2.438-6.352,7.531-4.953,12.28c1.352,4.562,5.531,7.656,10.226,7.656c0.203,0,0.406,0,0.609-0.031l234.663-13.343
		c5.289-0.312,9.554-4.438,10.015-9.719S252.933,350.801,247.777,349.583z" />
                                    </g>
                                    <path style="fill:#AAB2BC;" d="M472.197,238.533c-22.671-60.17-65.325-72.81-97.121-72.81c-41.655,0-80.543,20.968-90.402,26.702
	c-0.766,0.219-1.516,0.547-2.234,0.953C207.967,235.72,50.621,299.117,49.043,299.773c-4.086,1.625-6.75,5.625-6.688,10.031
	s2.828,8.312,6.969,9.843c96.426,35.686,177.898,53.779,242.146,53.779c0.016,0,0,0,0,0c50.653,0,91.776-11.219,122.229-33.343
	c29.764-21.654,49.591-53.779,58.935-95.473C473.088,242.595,472.931,240.47,472.197,238.533z" />
                                    <path style="fill:#434A54;" d="M437.308,63.774c0,5.891-4.766,10.672-10.656,10.672s-10.671-4.781-10.671-10.672
	c0-5.89,4.781-10.671,10.671-10.671C432.543,53.103,437.308,57.885,437.308,63.774z" />
                                </svg>
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

                                <!--
                Dropdown menu, show/hide based on menu state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
                                <!--
                                <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                            </div>
                            -->
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <!-- Menu open: "block", Menu closed: "hidden" -->
                            <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <x-nav href="/" :active="request()->is('/')" :mobile="true">Dashboard</x-nav>
                    <x-nav href="/wishlist" :active="request()->is('/wishlist')" :mobile="true">Wishlist</x-nav>
                    <x-nav href="/recurring-outgoings" :active="request()->is('/recurring-outgoings')" :mobile="true">Recurring Outgoings</x-nav>
                    <x-nav href="/categories" :active="request()->is('/categories')" :mobile="true">Categories</x-nav>
                </div>
                <div class="border-t border-gray-700 pb-3 pt-4">
                    <div class="flex items-center px-5">
                        <div class="shrink-0">
                            <img class="size-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                        <div class="ml-3">
                            <div class="text-base/5 font-medium text-white">Tom Cook</div>
                            <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                        </div>
                    </div>
                    <!--
                    <div class="mt-3 space-y-1 px-2">
                        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
                    </div>
                    -->
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $page_title }}</h1>
                <div>{{ $buttons }}</div>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>


</body>

</html>