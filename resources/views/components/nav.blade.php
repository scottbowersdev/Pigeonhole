@props(['active' => false])

<?php
switch ($slot) {
    case 'Dashboard':
        $svg = '<svg class="w-5 h-5 mb-2 stroke-gray-500 group-hover:stroke-purple-600'.($active ? ' stroke-purple-600' : FALSE).'" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M3 9.5H21M3 14.5H21M8 4.5V19.5M6.2 19.5H17.8C18.9201 19.5 19.4802 19.5 19.908 19.282C20.2843 19.0903 20.5903 18.7843 20.782 18.408C21 17.9802 21 17.4201 21 16.3V7.7C21 6.5799 21 6.01984 20.782 5.59202C20.5903 5.21569 20.2843 4.90973 19.908 4.71799C19.4802 4.5 18.9201 4.5 17.8 4.5H6.2C5.0799 4.5 4.51984 4.5 4.09202 4.71799C3.71569 4.90973 3.40973 5.21569 3.21799 5.59202C3 6.01984 3 6.57989 3 7.7V16.3C3 17.4201 3 17.9802 3.21799 18.408C3.40973 18.7843 3.71569 19.0903 4.09202 19.282C4.51984 19.5 5.07989 19.5 6.2 19.5Z" stroke-width="2" ></path></svg>';
        break;
    case 'Wishlist':
        $svg = '<svg class="w-5 h-5 mb-2 stroke-gray-500 group-hover:stroke-purple-600'.($active ? ' stroke-purple-600' : FALSE).'" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>';
        break;
    case 'Recurring':
        $svg = '<svg class="w-5 h-5 mb-2 stroke-gray-500 group-hover:stroke-purple-600'.($active ? ' stroke-purple-600' : FALSE).'" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.00001 4C3.34315 4 2.00001 5.34314 2.00001 7L2 17C2 18.6569 3.34315 20 5 20H8C8.55228 20 9 19.5523 9 19C9 18.4477 8.55228 18 8 18H5C4.44771 18 4 17.5523 4 17V7C4 6.44772 4.44771 6 5 6L19 6C19.5523 6 20 6.44772 20 7L20 17C20 17.5523 19.5523 18 19 18H14.0027L15.2821 16.7161C15.6734 16.3235 15.6734 15.687 15.2821 15.2944C14.8909 14.9019 14.2566 14.9019 13.8654 15.2944L11.5937 17.574L11.5805 17.5873C10.804 18.3724 10.8057 19.6406 11.5859 20.4234L13.8604 22.7058C14.2513 23.0981 14.8852 23.0981 15.2762 22.7058C15.6672 22.3134 15.6672 21.6773 15.2762 21.285L13.9956 20H19C20.6569 20 22 18.6569 22 17L22 7C22 5.34315 20.6569 4 19 4L5.00001 4Z"></path> </svg>';
        break;
    case 'Categories':
        $svg = '<svg class="w-5 h-5 mb-2 stroke-gray-500 group-hover:stroke-purple-600'.($active ? ' stroke-purple-600' : FALSE).'" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M17 10H19C21 10 22 9 22 7V5C22 3 21 2 19 2H17C15 2 14 3 14 5V7C14 9 15 10 17 10Z"  stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M5 22H7C9 22 10 21 10 19V17C10 15 9 14 7 14H5C3 14 2 15 2 17V19C2 21 3 22 5 22Z" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 10C8.20914 10 10 8.20914 10 6C10 3.79086 8.20914 2 6 2C3.79086 2 2 3.79086 2 6C2 8.20914 3.79086 10 6 10Z" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M18 22C20.2091 22 22 20.2091 22 18C22 15.7909 20.2091 14 18 14C15.7909 14 14 15.7909 14 18C14 20.2091 15.7909 22 18 22Z"stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';
        break;
    case 'Profile':
        $svg = '<svg class="w-5 h-5 mb-2 stroke-gray-500 group-hover:stroke-purple-600'.($active ? ' stroke-purple-600' : FALSE).'" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';
        break;
    case 'Logout':
        $svg = '<svg class="w-5 h-5 mb-2 stroke-gray-500 group-hover:stroke-purple-600'.($active ? ' stroke-purple-600' : FALSE).'" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 12H20M20 12L17 9M20 12L17 15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 12C4 7.58172 7.58172 4 12 4M12 20C9.47362 20 7.22075 18.8289 5.75463 17" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>';
        break;
    default: 
        $svg = '';
        break;
}
?>

<a class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-800 group"
    aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {!! $svg !!}
    <span
        class="text-xs text-gray-400 group-hover:text-purple-400{{ $active ? ' text-purple-400' : '' }}">{{ $slot }}</span>
</a>
