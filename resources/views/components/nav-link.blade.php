@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-white dark:border-white text-sm font-medium leading-5 text-white dark:text-white focus:outline-none focus:border-white transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white dark:text-white hover:text-sky-100 dark:hover:text-sky-100 hover:border-sky-200 dark:hover:border-sky-300 focus:outline-none focus:text-sky-100 dark:focus:text-sky-100 focus:border-sky-200 dark:focus:border-sky-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
