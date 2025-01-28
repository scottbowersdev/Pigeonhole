<x-layout>

    <x-slot:meta_title>Login - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>Login</x-slot:page_title>
    <x-slot:buttons><a href="/" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Back</a></x-slot:buttons>

    <form class="max-w-screen-md m-auto" method="POST" action="/login">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="grid grid-cols-2">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="email">Email</x-form.label>
                                <div class="mt-2">
                                    <x-form.input type="text" name="email" id="email" placeholder="john@example.com" required />
                                    <x-form.error name="email"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="password">Password</x-form.label>
                                <div class="mt-2">
                                    <x-form.input name="password" id="password" required />
                                    <x-form.error name="password"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6 p-3">
            <a href="/" class="text-sm/6 font-semibold text-gray-900">Back</a>
            <x-form.button type="submit">Log in</x-form.button>
        </div>
    </form>


</x-layout>