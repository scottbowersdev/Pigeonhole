<x-layout>

    <x-slot:meta_title>Add new wishlist item - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>Add new wishlist item</x-slot:page_title>
    <x-slot:buttons><a href="/wishlist" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Back</a></x-slot:buttons>

    <form class="max-w-screen-md m-auto" method="POST" action="/wishlist">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Add new wishlist item</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Please add your new information below.</p>

                <div class="grid grid-cols-2">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <label for="priority" class="block text-sm/6 font-medium text-gray-900">Priority</label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 {{ $errors->has('priority') ? 'outline-red-500' : 'outline-gray-300' }} focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <input type="number" name="priority" id="priority" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="5">
                                </div>
                                @error('priority')
                                <span class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <label for="cost" class="block text-sm/6 font-medium text-gray-900">Cost</label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 {{ $errors->has('cost') ? 'outline-red-500' : 'outline-gray-300' }} focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">&pound;</div>
                                    <input type="number" min="0.01" step="0.01" name="cost" id="cost" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="59.99">
                                </div>
                                @error('cost')
                                <span class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <label for="title" class="block text-sm/6 font-medium text-gray-900">Name</label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 {{ $errors->has('title') ? 'outline-red-500' : 'outline-gray-300' }} focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <input type="text" name="title" id="title" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="Car Payment">
                                </div>
                                @error('title')
                                <span class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <label for="url" class="block text-sm/6 font-medium text-gray-900">URL</label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 {{ $errors->has('url') ? 'outline-red-500' : 'outline-gray-300' }} focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <input type="text" name="url" id="url" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="https://www.google.com">
                                </div>
                                @error('url')
                                <span class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6 p-3">
            <a href="/wishlist" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>


</x-layout>