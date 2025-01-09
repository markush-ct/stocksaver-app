<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

{{-- value comes from the dashboard layout when the livewire pages is extending to
and passing in a breadcrumb blade file through <x-slot:breadcrumbs> --}}
@aware(['breadcrumbs'])

<nav class="sticky top-0 z-10 flex items-center justify-between border-b border-gray-500 bg-gray-200 px-4 py-2 dark:border-gray-500 dark:bg-gray-800"
    aria-label="top navibation bar">

    <!-- sidebar toggle button for small screens  -->
    <button type="button" class="md:hidden inline-block text-gray-800 dark:text-gray-300"
        x-on:click="sidebarIsOpen = true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5"
            aria-hidden="true">
            <path
                d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2z" />
        </svg>
        <span class="sr-only">sidebar toggle</span>
    </button>

    <!-- breadcrumbs  -->
    {{ $breadcrumbs }}

    <!-- Profile Menu  -->
    <div x-data="{ userDropdownIsOpen: false }" class="relative" x-on:keydown.esc.window="userDropdownIsOpen = false">
        <button type="button"
            class="flex w-full cursor-pointer items-center rounded-lg gap-2 p-2 text-left text-gray-800 hover:bg-sky-900/5 hover:text-gray-950 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 dark:text-gray-300 dark:hover:bg-sky-400/5 dark:hover:text-gray-100 dark:focus-visible:outline-sky-400"
            x-bind:class="userDropdownIsOpen ? 'bg-sky-900/10 dark:bg-sky-400/10' : ''" aria-haspopup="true"
            x-on:click="userDropdownIsOpen = ! userDropdownIsOpen" x-bind:aria-expanded="userDropdownIsOpen">
            <img src="https://penguinui.s3.amazonaws.com/component-assets/avatar-7.webp"
                class="size-8 object-cover rounded-lg" alt="avatar" aria-hidden="true" />
            <div class="hidden md:flex flex-col">
                <span class="text-sm font-bold text-gray-950 dark:text-gray-100">{{ auth()->user()->name }}</span>
                <span class="text-xs" aria-hidden="true">{{ auth()->user()->email }}</span>
                <span class="sr-only">profile settings</span>
            </div>
        </button>

        <!-- menu -->
        <div x-cloak x-show="userDropdownIsOpen"
            class="absolute top-14 right-0 z-20 h-fit w-48 border divide-y divide-gray-500 border-gray-500 bg-gray-50 dark:divide-gray-500 dark:border-gray-500 dark:bg-gray-900 rounded-lg"
            role="menu" x-on:click.outside="userDropdownIsOpen = false"
            x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()"
            x-transition="" x-trap="userDropdownIsOpen">

            <div class="flex flex-col py-1.5">
                <a href="#"
                    class="flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-gray-800 underline-offset-2 hover:bg-sky-900/5 hover:text-gray-950 focus-visible:underline focus:outline-none dark:text-gray-300 dark:hover:bg-sky-400/5 dark:hover:text-gray-100"
                    role="menuitem">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="size-5 shrink-0" aria-hidden="true">
                        <path
                            d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z" />
                    </svg>
                    <span>Profile</span>
                </a>
            </div>

            <div class="flex flex-col py-1.5">
                <a href="#"
                    class="flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-gray-800 underline-offset-2 hover:bg-sky-900/5 hover:text-gray-950 focus-visible:underline focus:outline-none dark:text-gray-300 dark:hover:bg-sky-400/5 dark:hover:text-gray-100"
                    role="menuitem">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="size-5 shrink-0" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M7.84 1.804A1 1 0 0 1 8.82 1h2.36a1 1 0 0 1 .98.804l.331 1.652a6.993 6.993 0 0 1 1.929 1.115l1.598-.54a1 1 0 0 1 1.186.447l1.18 2.044a1 1 0 0 1-.205 1.251l-1.267 1.113a7.047 7.047 0 0 1 0 2.228l1.267 1.113a1 1 0 0 1 .206 1.25l-1.18 2.045a1 1 0 0 1-1.187.447l-1.598-.54a6.993 6.993 0 0 1-1.929 1.115l-.33 1.652a1 1 0 0 1-.98.804H8.82a1 1 0 0 1-.98-.804l-.331-1.652a6.993 6.993 0 0 1-1.929-1.115l-1.598.54a1 1 0 0 1-1.186-.447l-1.18-2.044a1 1 0 0 1 .205-1.251l1.267-1.114a7.05 7.05 0 0 1 0-2.227L1.821 7.773a1 1 0 0 1-.206-1.25l1.18-2.045a1 1 0 0 1 1.187-.447l1.598.54A6.992 6.992 0 0 1 7.51 3.456l.33-1.652ZM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Settings</span>
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-gray-800 underline-offset-2 hover:bg-sky-900/5 hover:text-gray-950 focus-visible:underline focus:outline-none dark:text-gray-300 dark:hover:bg-sky-400/5 dark:hover:text-gray-100"
                    role="menuitem">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="size-5 shrink-0" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M2.5 4A1.5 1.5 0 0 0 1 5.5V6h18v-.5A1.5 1.5 0 0 0 17.5 4h-15ZM19 8.5H1v6A1.5 1.5 0 0 0 2.5 16h15a1.5 1.5 0 0 0 1.5-1.5v-6ZM3 13.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm4.75-.75a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Payments</span>
                </a>
            </div>

            <div class="flex flex-col py-1.5">
                <button wire:click="logout" wire:loading.attr="disabled"
                    class="flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-gray-800 underline-offset-2 hover:bg-sky-900/5 hover:text-gray-950 focus-visible:underline focus:outline-none dark:text-gray-300 dark:hover:bg-sky-400/5 dark:hover:text-gray-100"
                    role="menuitem">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="size-5 shrink-0" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Sign Out</span>
                </button>
            </div>
        </div>
    </div>
</nav>
