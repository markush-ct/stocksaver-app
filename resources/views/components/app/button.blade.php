@props(['variant' => 'primary', 'size' => 'md', 'class' => ''])

@php
    $classes = [
        'primary' => 'cursor-pointer whitespace-nowrap rounded-lg bg-sky-900 px-4 py-2 font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-sky-400 dark:text-black dark:focus-visible:outline-sky-400',
        'secondary' => 'cursor-pointer whitespace-nowrap rounded-lg bg-indigo-900 px-4 py-2 font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-900 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-indigo-400 dark:text-black dark:focus-visible:outline-indigo-400',
        'alternate' => 'cursor-pointer whitespace-nowrap rounded-lg bg-gray-200 px-4 py-2 font-medium tracking-wide text-gray-950 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-200 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-gray-800 dark:text-gray-100 dark:focus-visible:outline-gray-800',
        'inverse' => 'cursor-pointer whitespace-nowrap rounded-lg bg-gray-900 px-4 py-2 font-medium tracking-wide text-gray-300 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-gray-50 dark:text-gray-800 dark:focus-visible:outline-gray-50',
        'info' => 'cursor-pointer whitespace-nowrap rounded-lg bg-sky-500 px-4 py-2 font-medium tracking-wide text-black transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-sky-500 dark:text-black dark:focus-visible:outline-sky-500',
        'danger' => 'cursor-pointer whitespace-nowrap rounded-lg bg-red-500 px-4 py-2 font-medium tracking-wide text-black transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-red-500 dark:text-black dark:focus-visible:outline-red-500',
        'warning' => 'cursor-pointer whitespace-nowrap rounded-lg bg-yellow-500 px-4 py-2 font-medium tracking-wide text-black transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-yellow-500 dark:text-black dark:focus-visible:outline-yellow-500',
        'success' => 'cursor-pointer whitespace-nowrap rounded-lg bg-green-500 px-4 py-2 font-medium tracking-wide text-black transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-green-500 dark:text-black dark:focus-visible:outline-green-500',
    ][$variant];

    $sizes = [
        'sm' => 'text-xs',
        'md' => 'text-sm',
        'lg' => 'text-md',
        'xl' => 'text-lg',
    ][$size];
@endphp

<!-- primary Button -->
<button
    {{ $attributes->merge(['type' => 'button', 'class' => "{$classes} {$sizes} {$class} inline-flex justify-center items-center gap-2"]) }}
>
    {{ $slot }}
</button>
