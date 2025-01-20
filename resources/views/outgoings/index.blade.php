<x-layout>

    <x-slot:meta_title>{{ date("F", mktime(0, 0, 0, $month['month'], 1)) }} {{ $month['year'] }} - Pigeonhole | Organise your money</x-slot:meta_title>

    <x-slot:page_title>
        {{ date("F", mktime(0, 0, 0, $month['month'], 1)) }} <span class="text-sm">{{ $month['year'] }}</span></x-slot:page_title>

    <x-slot:buttons>
        <a href="/month/{{ $month['id'] }}/new-outgoing" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Add new</a>
        <a href="/" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20 ml-6">Back</a>
    </x-slot:buttons>

    @php
    $total_out = $month->sumOfCosts($month->id);
    @endphp

    @if(session('success'))
    <x-messages type="success">{{ session('success') }}</x-messages>
    @endif

    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-bold text-slate-800">&pound;{{ number_format($month['income'],2) }}</h3>
        </div>
        <div class="ml-3">
            <div class="w-full max-w-sm min-w-[200px] relative">
                <div class="relative">
                    <input
                        class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                        placeholder="Search" />
                    <button
                        class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex flex-col w-full text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th width="10%" class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500 text-center">
                            Day
                        </p>
                    </th>
                    <th width="60%" class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Name
                        </p>
                    </th>
                    <th width="20%" class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Cost
                        </p>
                    </th>
                    <th width="20%" class="p-4 border-b border-slate-300 bg-slate-50">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($month->outgoings as $outgoing)
                @php if($outgoing->paid == 1) { $highlight_css = 'bg-green-50 border-emerald-200'; } elseif(date('d') > $outgoing->day) { $highlight_css = 'bg-red-50 border-red-200'; } else { $highlight_css = 'border-slate-200'; }
                @endphp
                <tr class="hover:font-semibold text-slate-800 border-b {{ $highlight_css }}">
                    <td class="p-4 py-5">
                        <p class="block text-xs text-center">{{ $outgoing->day }}</p>
                    </td>
                    <td class="p-4 py-5">
                        <p class="block text-sm">{{ $outgoing->title }}</p>
                    </td>
                    <td class="p-4 py-5">
                        <p class="block text-sm">&pound;{{ number_format($outgoing->cost,2) }}</p>
                    </td>
                    <td class="p-4 py-5">
                        <div class="block text-center">

                            <a href="/outgoings/paid/{{ $outgoing->id }}" class="inline-block">
                                @if($outgoing->paid == 0)
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                @elseif($outgoing->paid == 1)
                                <svg class="w-4 h-4" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.96967 16.4697C6.67678 16.7626 6.67678 17.2374 6.96967 17.5303C7.26256 17.8232 7.73744 17.8232 8.03033 17.5303L6.96967 16.4697ZM13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697L13.0303 12.5303ZM11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303L11.9697 11.4697ZM18.0303 7.53033C18.3232 7.23744 18.3232 6.76256 18.0303 6.46967C17.7374 6.17678 17.2626 6.17678 16.9697 6.46967L18.0303 7.53033ZM13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303L13.0303 11.4697ZM16.9697 17.5303C17.2626 17.8232 17.7374 17.8232 18.0303 17.5303C18.3232 17.2374 18.3232 16.7626 18.0303 16.4697L16.9697 17.5303ZM11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697L11.9697 12.5303ZM8.03033 6.46967C7.73744 6.17678 7.26256 6.17678 6.96967 6.46967C6.67678 6.76256 6.67678 7.23744 6.96967 7.53033L8.03033 6.46967ZM8.03033 17.5303L13.0303 12.5303L11.9697 11.4697L6.96967 16.4697L8.03033 17.5303ZM13.0303 12.5303L18.0303 7.53033L16.9697 6.46967L11.9697 11.4697L13.0303 12.5303ZM11.9697 12.5303L16.9697 17.5303L18.0303 16.4697L13.0303 11.4697L11.9697 12.5303ZM13.0303 11.4697L8.03033 6.46967L6.96967 7.53033L11.9697 12.5303L13.0303 11.4697Z" fill="#000000" />
                                </svg>
                                @endif
                            </a>

                            <a href="/edit-outgoing/{{ $outgoing->id }}" class="inline-block">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z" fill="#0F0F0F" />
                                </svg>
                            </a>
                            <a href="/outgoings/delete/{{ $outgoing->id }}" onclick="return confirm('Are you sure you want to delete this outgoing?')" class="inline-block">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M14 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Totals card -->
    <div class="w-full mt-8 bg-white border border-gray-200 rounded-lg shadow">
        <div class="border-t border-gray-200">
            <div class=" p-4 bg-white rounded-lg md:p-8" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 sm:p-8">
                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">&pound;{{ number_format($total_out,2) }}</dt>
                        <dd class="text-gray-500">Total Out</dd>
                        <dd class="text-gray-400 text-sm font-semibold">{{ number_format(($total_out / $month->income) * 100, 2) }}%</dd>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">&pound;{{ number_format(($month->income - $total_out),2) }}</dt>
                        <dd class="text-gray-500">Total Remaining</dd>
                        <dd class="text-gray-400 text-sm font-semibold">{{ number_format(((($month->income - $total_out)) / $month->income) * 100, 2) }}%</dd>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">&pound;{{ number_format((($month->income - $total_out) / 4),2) }}</dt>
                        <dd class="text-gray-500 mb-2">Weekly Budget</dd>
                        <dd class="text-gray-400 text-sm font-semibold">&nbsp;</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="w-full mt-8 bg-white border border-gray-200 rounded-lg shadow p-8">
        <canvas id="myChart" class="w-full bg-white"></canvas>
    </div>

    <script>
        var curr_month = {{ $month -> month }};
        var data = @json($month->arrayOfOutgoings($month->id));

        function getDaysArrayByMonth() {
            var daysInMonth = moment("{{ $month->year }}-{{ $month->month }}", "YYYY-M").daysInMonth();
            var arrDays = [];

            while (daysInMonth) {
                var current = moment().date(daysInMonth);
                arrDays.push(current);
                daysInMonth--;
            }

            return arrDays;
        }

        var days = getDaysArrayByMonth();
        const labels = [];
        days.forEach(function(item) {
            labels.push(item.format("D"))
        });
        labels.reverse();

        new Chart("myChart", {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    label: "Outgoings",
                    borderColor: "#3cba9f",
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Outgoings per day'
                    }
                }
            }
        });
    </script>

</x-layout>