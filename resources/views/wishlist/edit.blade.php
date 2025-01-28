<x-layout>

    <x-slot:meta_title>Edit Wishlist Item - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>Edit Wishlist Item</x-slot:page_title>
    <x-slot:buttons><a href="/wishlist" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Back</a></x-slot:buttons>

    <form class="max-w-screen-md m-auto" method="POST" action="/wishlist/{{ $wishlist->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Edit Wishlist Item</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Please update your information below.</p>

                <div class="grid grid-cols-2">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="priority">Priority</x-form.label>
                                <div class="mt-2">
                                    <x-form.input type="number" name="priority" id="priority" value="{{ $wishlist->priority }}" placeholder="5" required />
                                    <x-form.error name="priority"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <x-form.label for="cost">Cost</x-form.label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 {{ $errors->has('cost') ? 'outline-red-500' : 'outline-gray-300' }} focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">&pound;</div>
                                    <input type="number" min="0.01" step="0.01" name="cost" id="cost" value="{{ $wishlist->cost }}" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="59.99" required>
                                </div>
                                <x-form.error name="cost"></x-form.error>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="title">Name</x-form.label>
                                <div class="mt-2">
                                    <x-form.input name="title" id="title" value="{{ $wishlist->title }}" placeholder="Car Payment" required />
                                    <x-form.error name="title"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="url">URL</x-form.label>
                                <div class="mt-2">
                                    <x-form.input name="url" id="url" value="{{ $wishlist->url }}" placeholder="https://www.google.com" />
                                    <x-form.error name="url"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6 p-3">
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
            </div>
            <div class="flex items-center gap-x-6">
                <a href="/wishlist" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
    </form>

    <form id="delete-form" method="POST" action="/wishlist/{{ $wishlist->id }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>


</x-layout>