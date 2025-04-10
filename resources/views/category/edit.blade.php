<x-layout>

    <x-slot:meta_title>Edit Category - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>Edit Category</x-slot:page_title>
    <x-slot:buttons><a href="/categories" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Back</a></x-slot:buttons>

    <div class="bg-gray-100 dark:bg-slate-900 flex items-center justify-center p-4">
        <div class="max-w-xl w-full bg-white dark:bg-slate-800 rounded-xl shadow-lg p-8">

            <form class="max-w-screen-md m-auto" method="POST" action="/categories/{{ $category->id }}">
                @csrf
                @method('PATCH')
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Edit category</h2>
                        <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-100">Please update your information below.</p>

                        <div class="grid grid-cols-2">

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <x-form.field>
                                    <div class="sm:col-span-5">
                                        <x-form.label for="name">Name</x-form.label>
                                        <div class="mt-2">
                                            <x-form.input name="name" id="name" value="{{ $category->name }}" placeholder="Eating Out" />
                                            <x-form.error name="name"></x-form.error>
                                        </div>
                                    </div>
                                </x-form.field>
                            </div>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <x-form.field>
                                    <label for="category" class="block text-sm/6 font-medium text-gray-900 dark:text-gray-100">Colour</label>
                                    <div class="mt-2 grid grid-cols-1">
                                    <select id="color" name="color" autocomplete="color" placeholder="-- Please Select --" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white dark:bg-slate-900 dark:text-gray-100 py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 {{ $errors->has('category') ? 'outline-red-500' : 'outline-gray-300' }} focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        <option value="">-- Please Select --</option>
                                        <option value="Gray"
                                        @if(old('color') == 'Gray' || $category->color == 'Gray')
                                            selected="selected"
                                        @endif
                                        >Gray</option>
                                        <option value="Red"
                                        @if(old('color') == 'Red' || $category->color == 'Red')
                                            selected="selected"
                                        @endif
                                        >Red</option>
                                        <option value="Yellow"
                                        @if(old('color') == 'Yellow' || $category->color == 'Yellow')
                                            selected="selected"
                                        @endif
                                        >Yellow</option>
                                        <option value="Green"
                                        @if(old('color') == 'Green'|| $category->color == 'Green')
                                            selected="selected"
                                        @endif
                                        >Green</option>
                                        <option value="Blue"
                                        @if(old('color') == 'Blue' || $category->color == 'Blue')
                                            selected="selected"
                                        @endif>Blue</option>

                                        <option value="Purple"
                                        @if(old('color') == 'Purple' || $category->color == 'Purple')
                                            selected="selected"
                                        @endif>Purple</option>

                                    </select>
                                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                    </svg>
                                    </div>
                                    <x-form.error name="color"></x-form.error>
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
                        <a href="/categories" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Cancel</a>
                        <x-form.button type="submit">Save</x-form.button>
                    </div>
                </div>
            </form>

            <form id="delete-form" method="POST" action="/categories/{{ $category->id }}" class="hidden">
                @csrf
                @method('DELETE')
            </form>

        </div>
    </div>

</x-layout>