<x-login-layout>

    <x-slot:meta_title>Register - Pigeonhole | Organise your money</x-slot:meta_title>

    <div class="min-h-screen bg-gray-100 dark:bg-slate-900 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white dark:bg-slate-800 rounded-xl shadow-lg p-8">
          <div class="items-center justify-center flex mb-6">
            <a href="/login">
                <x-logo />
            </a>
          </div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Register</h2>
          
          <form class="space-y-4" method="POST" action="/register">
            @csrf

            <div>
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
            
            <div>
                <x-form.field>
                    <div class="sm:col-span-5">
                        <x-form.label for="first_name">First name</x-form.label>
                        <div class="mt-2">
                            <x-form.input type="text" name="first_name" id="first_name" placeholder="John" :value="old('first_name')" required />
                            <x-form.error name="first_name"></x-form.error>
                        </div>
                    </div>
                </x-form.field>
              </div>

              <div>
                <x-form.field>
                    <div class="sm:col-span-5">
                        <x-form.label for="surname">Surname</x-form.label>
                        <div class="mt-2">
                            <x-form.input type="text" name="surname" id="surname" placeholder="Doe" :value="old('surname')" required />
                            <x-form.error name="surname"></x-form.error>
                        </div>
                    </div>
                </x-form.field>
              </div>

              <div>
                <div class="sm:col-span-5">
                    <x-form.label for="monthly_income">Monthly Income</x-form.label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white dark:bg-gray-900 pl-3 outline outline-1 -outline-offset-1 {{ $errors->has('monthly_income') ? 'outline-red-500' : 'outline-gray-300 dark:outline-black' }} focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <div class="shrink-0 select-none text-base text-gray-500 dark:text-gray-300 sm:text-sm/6">&pound;</div>
                            <input type="number" min="0.01" step="0.01" name="monthly_income" id="monthly_income" :value="old('monthly_income')" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base dark:text-white text-gray-900 dark:bg-slate-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="2000" required>
                        </div>
                        <x-form.error name="monthly_income"></x-form.error>
                    </div>
                </div>
              </div>
      
            <div>
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

            <div>
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
            
            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors">
              Create Account
            </button>
          </form>
      
          <div class="mt-6 text-center text-sm text-gray-600">
            Already have an account? 
            <a href="/login" class="text-indigo-600 hover:text-indigo-500 font-medium">Log In</a>
          </div>
        </div>
      </div>

</x-login-layout>