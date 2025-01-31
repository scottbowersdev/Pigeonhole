<x-layout>

    <x-slot:meta_title>Add New Category - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>Add new category</x-slot:page_title>
    <x-slot:buttons><a href="/categories" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Back</a></x-slot:buttons>

    <form class="max-w-screen-md m-auto" method="POST" action="/categories">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Add new category</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Please add your new category information below.</p>

                <div class="grid grid-cols-2">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="name">Name</x-form.label>
                                <div class="mt-2">
                                    <x-form.input name="name" id="name" placeholder="Eating Out" />
                                    <x-form.error name="name"></x-form.error>
                                </div>
                            </div>
                        </x-form.field>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <label for="color" class="block text-sm/6 font-medium text-gray-900">Colour</label>
                            <div class="mt-2 grid grid-cols-1">
                              <select id="color" name="color" autocomplete="color" placeholder="-- Please Select --" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 {{ $errors->has('color') ? 'outline-red-500' : 'outline-gray-300' }} focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option value="">-- Please Select --</option>
                                <option value="Gray"
                                @if(old('color') == 'Gray')
                                    selected="selected"
                                @endif
                                >Gray</option>
                                <option value="Red"
                                @if(old('color') == 'Red')
                                    selected="selected"
                                @endif
                                >Red</option>
                                <option value="Yellow"
                                @if(old('color') == 'Yellow')
                                    selected="selected"
                                @endif
                                >Yellow</option>
                                <option value="Green"
                                @if(old('color') == 'Green')
                                    selected="selected"
                                @endif
                                >Green</option>
                                <option value="Blue"
                                @if(old('color') == 'Blue')
                                    selected="selected"
                                @endif>Blue</option>

                                <option value="Purple"
                                @if(old('color') == 'Purple')
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

        <div class="mt-6 flex items-center justify-end gap-x-6 p-3">
            <a href="/categories" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <x-form.button type="submit">Save</x-form.button>
        </div>
    </form>


</x-layout>