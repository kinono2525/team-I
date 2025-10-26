@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-white dark:border-white text-start text-base font-medium text-white dark:text-white bg-sky-500 dark:bg-sky-700 focus:outline-none focus:text-white dark:focus:text-white focus:bg-sky-600 dark:focus:bg-sky-800 focus:border-white dark:focus:border-white transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white dark:text-white hover:text-sky-100 dark:hover:text-sky-100 hover:bg-sky-500 dark:hover:bg-sky-700 hover:border-sky-200 dark:hover:border-sky-300 focus:outline-none focus:text-sky-100 dark:focus:text-sky-100 focus:bg-sky-500 dark:focus:bg-sky-700 focus:border-sky-200 dark:focus:border-sky-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
