<x-layout>

    <x-slot:meta_title>Edit Recurring Outgoing - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>Edit Recurring Outgoing</x-slot:page_title>
    <x-slot:buttons><a href="/recurring-outgoings" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Back</a></x-slot:buttons>

    <form class="max-w-screen-md m-auto" method="POST" action="/recurring-outgoings/{{ $recurring_outgoings->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Edit Recurring Outgoing</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Please update your information below.</p>

                <div class="grid grid-cols-2">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-5">
                            <label for="day" class="block text-sm/6 font-medium text-gray-900">Day</label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 {{ $errors->has('day') ? 'outline-red-500' : 'outline-gray-300' }} focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                    <input
                                        type="number"
                                        name="day"
                                        id="day"
                                        class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                        value="{{ $recurring_outgoings->day }}"
                                        placeholder="5">
                                </div>
                                @error('day')
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
                                    <input
                                        type="number"
                                        min="0.01"
                                        step="0.01"
                                        name="cost"
                                        id="cost"
                                        class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                        value="{{ $recurring_outgoings->cost }}"
                                        placeholder="59.99">
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
                                    <input
                                        type="text"
                                        name="title"
                                        id="title"
                                        class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                        value="{{ $recurring_outgoings->title }}"
                                        placeholder="Car Payment">
                                </div>
                                @error('title')
                                <span class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6 p-3">
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
            </div>
            <div class="flex items-center gap-x-6">
                <a href="/recurring-outgoings" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
    </form>

    <form id="delete-form" method="POST" action="/recurring-outgoings/{{ $recurring_outgoings->id }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>


</x-layout>