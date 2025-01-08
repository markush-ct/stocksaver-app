@props(['variant' => 'primary'])

@php
    $classes = [
        'inverse' => 'inline-flex flex-row items-center gap-1 cursor-pointer whitespace-nowrap bg-transparent rounded-lg p-0.5 text-sm font-medium tracking-wide text-gray-900 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:text-gray-50 dark:focus-visible:outline-gray-50',
        'primary' => 'inline-flex flex-row items-center gap-1 cursor-pointer whitespace-nowrap rounded-lg bg-transparent p-0.5 font-semibold text-sky-900 outline-sky-900 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-sky-400 dark:outline-sky-400',
        'danger' => 'inline-flex flex-row items-center gap-1 cursor-pointer whitespace-nowrap bg-transparent rounded-lg p-0.5 font-semibold text-red-500 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:text-red-500 dark:focus-visible:outline-red-500',
    ]
@endphp


<button {{ $attributes->merge(['class' => $classes[$variant], 'type' => 'button']) }}>
    {{ $slot }}
</button>
