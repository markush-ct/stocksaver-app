@php
    $links = [
        [
            'routeName' => 'dashboard',
            'label' => 'Dashboard',
            'icon' => '<i class="ph-fill ph-speedometer text-[24px]"></i>',
        ],
        [
            'routeName' => 'category.index',
            'label' => 'Categories',
            'icon' => '<i class="ph-fill ph-list text-[24px]"></i>',
        ],
    ];
@endphp

<div x-data="{ sidebarIsOpen: false }" class="relative flex w-full flex-col md:flex-row">
    <!-- This allows screen readers to skip the sidebar and go directly to the main content. -->
    <a class="sr-only" href="#main-content">skip to the main content</a>

    <!-- dark overlay for when the sidebar is open on smaller screens  -->
    <div x-cloak x-show="sidebarIsOpen" class="fixed inset-0 z-20 bg-gray-900/10 backdrop-blur-sm md:hidden"
        aria-hidden="true" x-on:click="sidebarIsOpen = false" x-transition.opacity></div>

    <nav x-cloak
        class="fixed left-0 z-30 flex h-svh w-60 shrink-0 flex-col border-r border-gray-500 bg-gray-200 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative dark:border-gray-500 dark:bg-gray-800"
        x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">
        <!-- logo  -->
        <x-app.logo />

        <!-- search  -->
        <div class="relative my-4 flex w-full max-w-xs flex-col gap-1 text-gray-800 dark:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                stroke-width="2"
                class="absolute left-2 top-1/2 size-5 -translate-y-1/2 text-gray-800/50 dark:text-gray-300/50"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="search"
                class="w-full border border-gray-500 rounded-lg bg-gray-50 px-2 py-1.5 pl-9 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 disabled:cursor-not-allowed disabled:opacity-75 dark:border-gray-500 dark:bg-gray-900/50 dark:focus-visible:outline-sky-400"
                name="search" aria-label="Search" placeholder="Search" />
        </div>

        <!-- sidebar links  -->
        <div class="flex flex-col gap-2 overflow-y-auto pb-6">
            @foreach ($links as $link)
                <x-app.sidebar-link wire:navigate :href="route($link['routeName'])" :active="request()->routeIs($link['routeName'])">
                    <!-- render the icon unescaped  -->
                    {!! $link['icon'] !!}
                    <span>{{ $link['label'] }}</span>
                </x-app.sidebar-link>
            @endforeach
        </div>
    </nav>

    {{ $slot }}
</div>
