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
    $category_tots = [];
    @endphp

    @if(session('success'))
    <x-messages type="success">{{ session('success') }}</x-messages>
    @endif

    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 id="monthlyIncome" class="text-lg font-bold text-slate-800 dark:text-gray-100">&pound;{{ number_format($month['income'],2) }}</h3>
            <form id="editMonthlyIncome" class="hidden" method="POST" action="/month/{{ $month->id }}">
                @csrf
                @method('PATCH')
                <div class="flex items-center rounded-md bg-white dark:bg-black pl-3 outline-1 -outline-offset-1 {{ $errors->has('cost') ? 'outline-red-500' : 'outline-gray-300 dark:outline-black' }} focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <div class="shrink-0 select-none text-base text-gray-500 dark:text-gray-300 sm:text-sm/6">&pound;</div>
                    <input type="number" min="0.01" step="0.01" name="monthly_income" id="monthly_income" value="{{ $month->income }}" class="block min-w-0 grow py-1.5 pl-1 px-3 text-base dark:text-white text-gray-900 dark:bg-black placeholder:text-gray-400 focus:outline-0 sm:text-sm/6" placeholder="2000" required>
                </div>
            </form>
        </div>
        <div class="ml-3">
            <div class="w-full max-w-sm min-w-[200px] relative">
                <div class="relative">
                    <input
                        class="dark:bg-black dark:border-slate-800 dark:text-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                        placeholder="Search" />
                    <button
                        class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white dark:bg-black rounded "
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex flex-col w-full text-gray-700 bg-white shadow-md rounded-lg bg-clip-border overflow-x-auto">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th class="px-2 py-4 sm:p-4 border-b border-slate-300 bg-slate-50 dark:bg-black dark:border-slate-700">
                        <p class="block text-sm font-normal leading-none text-slate-500 dark:text-white text-center">
                            Day
                        </p>
                    </th>
                    <th class="px-2 py-4 sm:p-4 border-b border-slate-300 bg-slate-50 dark:bg-black dark:border-slate-700">
                        <p class="block text-sm font-normal leading-none text-slate-500 dark:text-white">
                            Name
                        </p>
                    </th>
                    <th  class="px-2 py-4 sm:p-4 border-b border-slate-300 bg-slate-50 dark:bg-black dark:border-slate-700">
                        <p class="block text-sm font-normal leading-none text-slate-500 dark:text-white">
                            Cost
                        </p>
                    </th>
                    <th class="px-2 py-4 sm:p-4 border-b border-slate-300 bg-slate-50 dark:bg-black dark:border-slate-700">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($month->outgoings as $outgoing)
                @php if($outgoing->paid == 1) { 
                    $highlight_css = 'bg-green-50 border-emerald-200 dark:bg-emerald-900 dark:border-emerald-800'; 
                } elseif(date('d') > $outgoing->day && $month->month == date('m')) { 
                    $highlight_css = 'bg-red-50 border-red-200 dark:bg-red-900 dark:border-red-800'; 
                } else { 
                    $highlight_css = 'border-slate-200 dark:bg-slate-800 dark:border-slate-900'; 
                }
                if($outgoing->categories->count() > 0 && isset($category_tots[$outgoing->categories->first()->id])) {
                    $category_tots[$outgoing->categories->first()->id] += $outgoing->cost; 
                } elseif($outgoing->categories->count() > 0 && !isset($category_tots[$outgoing->categories->first()->id])) {
                    $category_tots[$outgoing->categories->first()->id] = $outgoing->cost; 
                }
                @endphp
                <tr class="text-slate-800 dark:text-gray-100 border-b {{ $highlight_css }}">
                    <td class="px-2 py-4 sm:p-4 ">
                        <p class="block text-xs text-center">{{ $outgoing->day }}</p>
                    </td>
                    <td class="px-2 py-4 sm:p-4 flex">
                        <p class="text-sm flex-1">
                            {{ $outgoing->title }}
                            @if($outgoing->categories()->exists())
                            <x-badge class="{{ $outgoing->categories->first()->css_classes() }} ml-2 hidden">{{ $outgoing->categories->first()->name }}</x-badge>
                            @endif
                        </p>
                        @if($outgoing->recurring == 1)
                            <svg class="hidden sm:table-cell w-4 h-4 flex-1 stroke-black stroke-2 dark:stroke-gray-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 2L21 6M21 6L17 10M21 6H7.8C6.11984 6 5.27976 6 4.63803 6.32698C4.07354 6.6146 3.6146 7.07354 3.32698 7.63803C3 8.27976 3 9.11984 3 10.8V11M3 18H16.2C17.8802 18 18.7202 18 19.362 17.673C19.9265 17.3854 20.3854 16.9265 20.673 16.362C21 15.7202 21 14.8802 21 13.2V13M3 18L7 22M3 18L7 14" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        @endif
                    </td>
                    <td class="px-2 py-4 sm:p-4 ">
                        <p class="block text-sm">&pound;{{ number_format($outgoing->cost,2) }}</p>
                    </td>
                    <td class="px-2 py-4 sm:p-4 ">
                        <div class="block text-center">

                            <a href="/outgoings/paid/{{ $outgoing->id }}" class="inline-block">
                                @if($outgoing->paid == 0)
                                <svg class="w-4 h-4 stroke-black stroke-2 dark:stroke-gray-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                @elseif($outgoing->paid == 1)
                                <svg class="w-4 h-4 stroke-black stroke-1 dark:fill-gray-100 dark:stroke-gray-100" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.96967 16.4697C6.67678 16.7626 6.67678 17.2374 6.96967 17.5303C7.26256 17.8232 7.73744 17.8232 8.03033 17.5303L6.96967 16.4697ZM13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697L13.0303 12.5303ZM11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303L11.9697 11.4697ZM18.0303 7.53033C18.3232 7.23744 18.3232 6.76256 18.0303 6.46967C17.7374 6.17678 17.2626 6.17678 16.9697 6.46967L18.0303 7.53033ZM13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303L13.0303 11.4697ZM16.9697 17.5303C17.2626 17.8232 17.7374 17.8232 18.0303 17.5303C18.3232 17.2374 18.3232 16.7626 18.0303 16.4697L16.9697 17.5303ZM11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697L11.9697 12.5303ZM8.03033 6.46967C7.73744 6.17678 7.26256 6.17678 6.96967 6.46967C6.67678 6.76256 6.67678 7.23744 6.96967 7.53033L8.03033 6.46967ZM8.03033 17.5303L13.0303 12.5303L11.9697 11.4697L6.96967 16.4697L8.03033 17.5303ZM13.0303 12.5303L18.0303 7.53033L16.9697 6.46967L11.9697 11.4697L13.0303 12.5303ZM11.9697 12.5303L16.9697 17.5303L18.0303 16.4697L13.0303 11.4697L11.9697 12.5303ZM13.0303 11.4697L8.03033 6.46967L6.96967 7.53033L11.9697 12.5303L13.0303 11.4697Z" />
                                </svg>
                                @endif
                            </a>

                            <a href="/outgoings/edit/{{ $outgoing->id }}" class="inline-block">
                                <svg class="w-4 h-4 stroke-black stroke-0 dark:fill-gray-100 dark:stroke-gray-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z" />
                                </svg>
                            </a>
                            <a href="/outgoings/delete/{{ $outgoing->id }}" onclick="return confirm('Are you sure you want to delete this outgoing?')" class="inline-block">
                                <svg class="w-4 h-4 stroke-black stroke-2 dark:stroke-gray-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 11V17" class="stroke-black stroke-2 dark:stroke-gray-100" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M14 11V17" class="stroke-black stroke-2 dark:stroke-gray-100" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 7H20" class="stroke-black stroke-2 dark:stroke-gray-100" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" class="stroke-black stroke-2 dark:stroke-gray-100" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" class="stroke-black stroke-2 dark:stroke-gray-100" stroke-linecap="round" stroke-linejoin="round" />
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
    <h2 class="mt-10 text-xl font-semibold text-center dark:text-gray-100">Outgoings Breakdown</h2>
    <div class="w-full mt-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-slate-800 dark:border-slate-900">
        <div class="">
            <div class=" p-4 rounded-lg md:p-8" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                <dl class="grid max-w-screen-xl grid-cols-1 gap-8 p-4 mx-auto text-gray-900 dark:text-gray-200 sm:grid-cols-3 sm:p-8">
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

    <!-- Categories card -->
    <h2 class="mt-10 text-xl font-semibold text-center dark:text-gray-100">Category Breakdown</h2>
    <div class="flex flex-wrap justify-center mt-4">

        @foreach($category_tots as $id => $total) 
        @php $category = App\Models\Category::find($id); @endphp
        <div class="w-full sm:w-1/2 md:w-1/4 lg:w-1/5 mx-2 mb-4">
            <div class="flex h-full border rounded-lg shadow p-8 flex-col text-center {{ $category->css_classes() }}">
                <div class="mb-3">
                    <h2 class="text-lg font-medium text-center">{{ $category->name }}</h2>
                </div>
                <div class="justify-between flex-grow">
                    <p class="mb-2 text-2xl font-extrabold">
                        &pound;{{ number_format($total, 2) }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    
    </div>

    <!-- Charts -->
    <h2 class="mt-10 text-xl font-semibold text-center dark:text-gray-100">Outgoings per day</h2>
    <div class="w-full mt-4 bg-white border border-gray-200 dark:bg-slate-800 dark:border-slate-900 rounded-lg shadow p-8">
        <canvas id="myChart" class="w-full bg-white dark:bg-slate-800"></canvas>
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
                    borderColor: "#0E172B",
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                    
                }
            }
        });
    </script>
    <script>
        var monthlyIncomeDisplay = document.getElementById("monthlyIncome");
        var monthlyIncomeForm = document.getElementById("editMonthlyIncome");

        monthlyIncomeDisplay.addEventListener("click", function() {
            monthlyIncomeDisplay.style.display = "none";
            monthlyIncomeForm.style.display = "block";
        });
    </script>

</x-layout>