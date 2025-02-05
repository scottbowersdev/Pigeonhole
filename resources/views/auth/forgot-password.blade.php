<x-login-layout>

    <x-slot:meta_title>Forgot Password - Pigeonhole | Organise your money</x-slot:meta_title>

    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
          <div class="items-center justify-center flex mb-6">
            <a href="/login">
                <x-logo />
            </a>
          </div>
          <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Forgot Password</h2>

          <p>Please enter the email address associated with your account below and we will send you a password reset link.</p>

          @if (session('status'))
            <x-messages type="success">{{ session('status') }}</x-messages>
          @endif
          
          <form class="space-y-4" method="POST" action="/forgot-password">
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
                        
            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors">
              Submit
            </button>
          </form>
      
          <div class="mt-6 text-center text-sm text-gray-600">
            <a href="/login" class="text-indigo-600 hover:text-indigo-500 font-medium">Back to Log In</a>
          </div>
        </div>
      </div>

</x-login-layout>