<x-layout>

    <x-slot:meta_title>Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>Dashboard</x-slot:page_title>
    <x-slot:buttons></x-slot:buttons>

    <ul role="list" class="divide-y divide-gray-100">
        @foreach ($months as $month)
        <a href="/month/{{ $month['id'] }}" class="hover:text-white">
            <li class="flex justify-between gap-x-6 p-5 hover:bg-slate-900 hover:!text-white {{ ($loop->iteration % 2 == 0 ? 'bg-slate-200' : FALSE) }}">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-md/6 font-semibold">{{ date("F", mktime(0, 0, 0, $month['month'], 1)) }}</p>
                        <p class="mt-1 truncate text-xs/6 text-gray-500">{{ $month['year'] }}</p>
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <p class="text-md/6">&pound;{{ number_format($month['income'],2) }}</p>
                    <p class="mt-1 text-xs/6 text-gray-500">{{ count($month->outgoings) }} Outgoing{{ (count($month->outgoings) == 1 ? FALSE : 's') }}</p>
                </div>
            </li>
        </a>
        @endforeach
    </ul>

</x-layout>