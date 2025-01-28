<x-layout>

    <x-slot:meta_title>Edit Outgoing - {{ date("F", mktime(0, 0, 0, $month->month, 1)) }} {{ $month->year }} - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>{{ date("F", mktime(0, 0, 0, $month->month, 1)) }} {{ $month->year }}</x-slot:page_title>
    <x-slot:buttons><a href="/month/{{ $month['id'] }}" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Back</a></x-slot:buttons>

    <form class="max-w-screen-md m-auto" method="POST" action="/outgoings/{{ $outgoing->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Edit outgoing</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Please update your information below.</p>

                <div class="grid grid-cols-2">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form.field>
                            <div class="sm:col-span-5">
                                <x-form.label for="day">Day of the month</x-form.label>
                                <div class="mt-2">
                                    <x-form.input type="number" name="day" min="1" max="31" id="day" value="{{ $outgoing->day }}" placeholder="5" required />
                                    <x-form.error name="day"></x-form.error>
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
                                    <input type="number" min="0.01" step="0.01" name="cost" id="cost" value="{{ $outgoing->cost }}" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="59.99" required>
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
                                    <x-form.input name="title" id="title" value="{{ $outgoing->title }}" placeholder="Car Payment" required />
                                    <x-form.error name="title"></x-form.error>
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
                <a href="/month/{{ $month['id'] }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                <x-form.button type="submit">Save</x-form.button>
            </div>
        </div>
    </form>

    <form id="delete-form" method="POST" action="/outgoings/{{ $outgoing->id }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>


</x-layout>