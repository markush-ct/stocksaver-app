@props(['links'])

@php
    $finalLinks = [
        [
            'label' => 'Dashboard',
            'routeName' => 'dashboard',
        ],
    ];

    array_push($finalLinks, ...$links);
@endphp

<!-- breadcrumbs  -->
<nav class="hidden md:inline-block text-sm font-medium text-gray-800 dark:text-gray-300" aria-label="breadcrumb">
    <ol class="flex flex-wrap items-center gap-1">
        @foreach ($finalLinks as $link)
            @if (isset($link['routeName']))
                <li class="flex items-center gap-1">
                    <a wire:navigate href="{{ route($link['routeName']) }}" class="hover:text-gray-950 dark:hover:text-gray-100">
                        {{ $link['label'] }}
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                        stroke-width="2" class="size-4" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </li>
            @endif

            @if (! isset($link['routeName']))
                <li class="flex items-center gap-1 font-bold text-gray-950 dark:text-gray-100" aria-current="page">
                    {{ $link['label'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
