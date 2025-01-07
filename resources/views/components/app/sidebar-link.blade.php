@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center rounded-lg gap-2 bg-sky-900/10 px-2 py-1.5 text-sm font-medium text-gray-950 underline-offset-2 focus-visible:underline focus:outline-none dark:bg-sky-400/10 dark:text-gray-100'
    : 'flex items-center rounded-lg gap-2 px-2 py-1.5 text-sm font-medium text-gray-950 underline-offset-2 focus-visible:underline focus:outline-none dark:text-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}

    @if ($active)
        <span class="sr-only">active</span>
    @endif
</a>
