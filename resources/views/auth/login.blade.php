<x-login-layout>

    <x-slot:meta_title>Login - Pigeonhole | Organise your money</x-slot:meta_title>

    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
            <div class="items-center justify-center flex mb-6">
                <a href="/login">
                    <x-logo />
                </a>
              </div>
          <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Log In</h2>
          
          <form class="space-y-4" method="POST" action="/login">
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
                        <x-form.label for="password">Password</x-form.label>
                        <div class="mt-2">
                            <x-form.input name="password" id="password" type="password" placeholder="••••••••" required />
                            <x-form.error name="password"></x-form.error>
                        </div>
                    </div>
                </x-form.field>
            </div>
      
            <div class="flex items-center justify-between">
              <label class="flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
              </label>
              <a href="/forgot-password" class="text-sm text-indigo-600 hover:text-indigo-500">Forgot password?</a>
            </div>
      
            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors">
              Sign In
            </button>
          </form>
      
          <div class="mt-6 text-center text-sm text-gray-600">
            Don't have an account? 
            <a href="/register" class="text-indigo-600 hover:text-indigo-500 font-medium">Sign up</a>
          </div>
        </div>
      </div>

</x-login-layout>