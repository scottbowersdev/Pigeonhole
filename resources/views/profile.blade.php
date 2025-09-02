<x-layout>

    <x-slot:meta_title>My Profile - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>My Profile</x-slot:page_title>
    <x-slot:buttons></x-slot:buttons>

    @if(session('success'))
    <x-messages type="success">{{ session('success') }}</x-messages>
    @endif

    <div class="bg-gray-100 dark:bg-slate-900 flex items-center justify-center p-4">
        <div class="max-w-xl w-full bg-white dark:bg-slate-800 rounded-xl shadow-lg sm:p-8 p-4">

            <form class="max-w-screen-md m-auto" method="POST" action="/profile">
                @csrf
                @method('PATCH')
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">My Profile</h2>

                        <div class="grid sm:grid-cols-2 grid-cols-1">

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <x-form.field>
                                    <div class="sm:col-span-5">
                                        <x-form.label for="email">Email</x-form.label>
                                        <div class="mt-2">
                                            <x-form.input type="text" name="email" id="email" placeholder="john@example.com" :value="Auth::user()->email" required />
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
                                            <x-form.input type="text" name="first_name" id="first_name" placeholder="John" :value="Auth::user()->first_name" required />
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
                                            <x-form.input type="text" name="surname" id="surname" placeholder="Doe" :value="Auth::user()->surname" required />
                                            <x-form.error name="surname"></x-form.error>
                                        </div>
                                    </div>
                                </x-form.field>
                            </div>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-5">
                                    <x-form.label for="monthly_income">Monthly Income</x-form.label>
                                    <div class="mt-2">
                                        <div class="flex items-center rounded-md bg-white dark:bg-gray-900 pl-3 outline outline-1 -outline-offset-1 {{ $errors->has('monthly_income') ? 'outline-red-500' : 'outline-gray-300 dark:outline-black' }} focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                            <div class="shrink-0 select-none text-base text-gray-500 dark:text-gray-300 sm:text-sm/6">&pound;</div>
                                            <input type="number" min="0.01" step="0.01" name="monthly_income" id="monthly_income" value="{{ Auth::user()->monthly_income }}" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base dark:text-white text-gray-900 dark:bg-slate-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="2000" required>
                                        </div>
                
                                        <x-form.error name="monthly_income"></x-form.error>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between gap-x-6 p-3">
                    <a href="/" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                </div>
            </form>

        </div>
    </div>

</x-layout>