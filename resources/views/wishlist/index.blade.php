<x-layout>

    <x-slot:meta_title>Wishlist - Pigeonhole | Organise your money</x-slot:meta_title>

    <x-slot:page_title>My Wishlist</x-slot:page_title>

    <x-slot:buttons><a href="/wishlist/new" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Add new</a></x-slot:buttons>

    @if(session('success'))
    <x-messages type="success">{{ session('success') }}</x-messages>
    @endif

    @php $category_tots = [];
    @endphp

    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-gray-100">&pound;{{ number_format($wishlist->sum('cost'),2) }}</h3>
        </div>
        <div class="ml-3">
            <div class="w-full max-w-sm min-w-[200px] relative">
                <div class="relative">
                    <input
                        class="bg-white dark:bg-black dark:border-slate-800 dark:text-white w-full pr-11 h-10 pl-3 py-2 placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
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

    <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-lg bg-clip-border overflow-x-auto">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th width="10%" class="p-4 border-b border-slate-300 bg-slate-50 dark:bg-black dark:border-slate-700">
                        <p class="block text-sm font-normal leading-none text-slate-500 dark:text-white">
                            Priority
                        </p>
                    </th>
                    <th width="60%" class="p-4 border-b border-slate-300 bg-slate-50 dark:bg-black dark:border-slate-700">
                        <p class="block text-sm font-normal leading-none text-slate-500 dark:text-white">
                            Name
                        </p>
                    </th>
                    <th width="20%" class="p-4 border-b border-slate-300 bg-slate-50 dark:bg-black dark:border-slate-700">
                        <p class="block text-sm font-normal leading-none text-slate-500 dark:text-white">
                            Cost
                        </p>
                    </th>
                    <th width="20%" class="p-4 border-b border-slate-300 bg-slate-50 dark:bg-black dark:border-slate-700">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wishlist as $wishlist_item)
                @php 
                if($wishlist_item->categories->count() > 0 && isset($category_tots[$wishlist_item->categories->first()->id])) {
                    $category_tots[$wishlist_item->categories->first()->id] += $wishlist_item->cost; 
                } elseif($wishlist_item->categories->count() > 0 && !isset($category_tots[$wishlist_item->categories->first()->id])) {
                    $category_tots[$wishlist_item->categories->first()->id] = $wishlist_item->cost; 
                }
                @endphp
                <tr class="border-b border-slate-200 dark:bg-slate-800 dark:border-slate-900 dark:text-gray-100">
                    <td class="p-4 py-5">
                        <p class="block font-semibold text-sm text-slate-800 dark:text-gray-100">{{ $wishlist_item->priority }}</p>
                    </td>
                    <td class="p-4 py-5">
                        <p class="block text-sm text-slate-800 dark:text-gray-100">
                            @if(!empty($wishlist_item->url))
                            <a href="{{ $wishlist_item->url }}" target="_blank"><strong>
                                    @endif
                                    {{ $wishlist_item->title }}
                                    @if(!empty($wishlist_item->url))
                                </strong></a>
                            @endif
                            @if($wishlist_item->categories()->exists())
                            <x-badge class="{{ $wishlist_item->categories->first()->css_classes() }} ml-2">{{ $wishlist_item->categories->first()->name }}</x-badge>
                            @endif
                        </p>
                    </td>
                    <td class="p-4 py-5">
                        <p class="block text-sm text-slate-800 dark:text-gray-100">&pound;{{ $wishlist_item->cost }}</p>
                    </td>
                    <td class="p-4 py-5">
                        <div class="block text-center">

                            <a href="/wishlist/paid/{{ $wishlist_item->id }}" class="text-slate-600 hover:text-slate-800 inline-block">
                                <svg class="w-4 h-4 stroke-black stroke-1 dark:fill-gray-100 dark:stroke-gray-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>

                            <a href="/wishlist/edit/{{ $wishlist_item->id }}" class="text-slate-600 hover:text-slate-800 inline-block">
                                <svg class="w-4 h-4 stroke-black stroke-0 dark:fill-gray-100 dark:stroke-gray-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z" />
                                </svg>
                            </a>
                            <a href="/wishlist/delete/{{ $wishlist_item->id }}" onclick="return confirm('Are you sure you want to delete this wishlist item?')" class="text-slate-600 hover:text-slate-800 inline-block">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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

    <!-- Categories card -->
    @if(count($category_tots) > 0)
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
    @endif

</x-layout>