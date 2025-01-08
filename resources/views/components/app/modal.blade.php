<div {{ $attributes->merge(['x-data' => '{modalIsOpen: false}']) }}>
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false" class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="flex w-full max-w-4xl flex-col gap-4 overflow-hidden rounded-lg border border-gray-500 bg-gray-50 text-gray-800 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300">
            <!-- Dialog Header -->
            <div class="flex items-center justify-between border-b border-gray-500 bg-gray-200/60 p-4 dark:border-gray-500 dark:bg-gray-900/20">
                <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-gray-950 dark:text-gray-100">
                    {{ $modalHeader }}
                </h3>
                <button @click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-4 py-8">
                {{ $modalBody }}
            </div>
            <!-- Dialog Footer -->
            <div class="flex flex-col-reverse justify-between gap-2 border-t border-gray-500 bg-gray-200/60 p-4 dark:border-gray-500 dark:bg-gray-900/20 sm:flex-row sm:items-center md:justify-end">
                <button @click="modalIsOpen = false" type="button" class="cursor-pointer whitespace-nowrap rounded-lg px-4 py-2 text-center text-sm font-medium tracking-wide text-gray-800 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 active:opacity-100 active:outline-offset-0 dark:text-gray-300 dark:focus-visible:outline-sky-400">Close</button>
                {{ $modalFooter }}
            </div>
        </div>
    </div>
</div>
