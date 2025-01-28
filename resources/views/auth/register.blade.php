<x-layout>

    <x-slot:meta_title>Register - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>Register</x-slot:page_title>
    <x-slot:buttons><a href="/" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Back</a></x-slot:buttons>

    <form class="max-w-screen-md m-auto" method="POST" action="/register">
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
                                <x-form.label for="first_name">First name</x-form.label>
                                <div class="mt-2">
                                    <x-form.input type="text" name="first_name" id="first_name" placeholder="John" required />
                                    <x-form.error name="first_name"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="surname">Surname</x-form.label>
                                <div class="mt-2">
                                    <x-form.input type="text" name="surname" id="surname" placeholder="Doe" required />
                                    <x-form.error name="surname"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <x-form.label for="monthly_income">Monthly Income</x-form.label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 {{ $errors->has('cost') ? 'outline-red-500' : 'outline-gray-300' }} focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">&pound;</div>
                                    <input type="number" min="0.01" step="0.01" name="monthly_income" id="monthly_income" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="2000" required>
                                </div>
                                <x-form.error name="monthly_income"></x-form.error>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="password">Password</x-form.label>
                                <div class="mt-2">
                                    <x-form.input type="password" name="password" id="password" required />
                                    <x-form.error name="password"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="password_confirmation">Confirm Password</x-form.label>
                                <div class="mt-2">
                                    <x-form.input type="password" name="password_confirmation" id="password_confirmation" required />
                                    <x-form.error name="password_confirmation"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6 p-3">
            <a href="/" class="text-sm/6 font-semibold text-gray-900">Back</a>
            <x-form.button type="submit">Register</x-form.button>
        </div>
    </form>


</x-layout>