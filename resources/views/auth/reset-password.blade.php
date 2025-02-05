<x-login-layout>

    <x-slot:meta_title>Reset your Password - Pigeonhole | Organise your money</x-slot:meta_title>

    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
          <div class="items-center justify-center flex mb-6">
            <a href="/login">
                <x-logo />
            </a>
          </div>
          <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Password Reset</h2>

          <p>Please enter your new password below</p>

          @if (session('status'))
            <x-messages type="success">{{ session('status') }}</x-messages>
          @endif

          
          <form class="space-y-4" method="POST" action="/reset-password">
            @csrf
            @method('PATCH')
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <x-form.field>
                    <div class="sm:col-span-5">
                        <x-form.label for="email">Email</x-form.label>
                        <div class="mt-2">
                            <x-form.input type="text" name="email" id="email" :value="old('email')" placeholder="john@example.com" required />
                            <x-form.error name="email"></x-form.error>
                        </div>
                    </div>
                </x-form.field>
            </div>
      
            <div>
                <x-form.field>
                    <div class="sm:col-span-5">
                        <x-form.label for="password">New Password</x-form.label>
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
                        <x-form.label for="password_confirmation">Confirm New Password</x-form.label>
                        <div class="mt-2">
                            <x-form.input type="password" name="password_confirmation" id="password_confirmation" required />
                            <x-form.error name="password_confirmation"></x-form.error>
                        </div>
                    </div>
                </x-form.field>
            </div>
            
            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors">
              Update
            </button>
          </form>
      
        </div>
      </div>

</x-login-layout>