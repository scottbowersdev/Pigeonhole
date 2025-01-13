<x-layout>

    <x-slot:meta_title>{{ date("F", mktime(0, 0, 0, $month['month'], 1)) }} {{ $month['year'] }} - Pigeonhole | Organise your money</x-slot:meta_title>
    <x-slot:page_title>{{ date("F", mktime(0, 0, 0, $month['month'], 1)) }} {{ $month['year'] }}</x-slot:page_title>

    @foreach ($month->outgoings as $outgoing)

    <li>{{ $outgoing['title'] }}</li>

    @endforeach

</x-layout>