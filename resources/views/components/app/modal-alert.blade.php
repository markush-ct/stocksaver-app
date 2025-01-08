@props([
    'variant' => 'success',
    'size' => 'md',
    'title' => 'Modal Title',
    'message' => 'Modal Message',
    'isForDeletion' => false,
])

@php
    $icons = [
        'success' => '<i class="ph-fill ph-check-circle"></i>',
        'info' => '<i class="ph-fill ph-info"></i>',
        'warning' => '<i class="ph-fill ph-warning-circle"></i>',
        'danger' => '<i class="ph-fill ph-x-circle"></i>',
    ][$variant];

    $colors = [
        'success' => 'bg-green-500/20 text-green-500',
        'info' => 'bg-sky-500/20 text-sky-500',
        'warning' => 'bg-yellow-500/20 text-yellow-500',
        'danger' => 'bg-red-500/20 text-red-500',
    ][$variant];

    $sizes = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
    ][$size];
@endphp

<div {{ $attributes->merge(['x-data' => '{ modalIsOpen: false }']) }}>
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
        x-trap.inert.noscroll="modalIsOpen" @keydown.esc.window="modalIsOpen = false"
        @click.self="modalIsOpen = false"
        class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
        role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            {{ $attributes->class([$sizes, 'flex w-full flex-col gap-4 overflow-hidden rounded-lg border border-gray-500 bg-gray-50 text-gray-800 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300']) }}>
            <!-- Dialog Header -->
            <div
                class="flex items-center justify-between border-b border-gray-500 bg-gray-200/60 px-4 py-2 dark:border-gray-500 dark:bg-gray-900/20">
                <div {{ $attributes->class([$colors, 'flex items-center justify-center rounded-full p-1 text-2xl']) }}>
                    {!! $icons !!}
                </div>
                <button @click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-4 text-center">
                @if ($isForDeletion && $variant === 'danger')
                    <div {{ $attributes->class([$colors, 'inline-flex items-center rounded-full p-4 text-2xl mb-2']) }}>
                        <i class="ph-bold ph-trash"></i>
                    </div>
                @endif
                <h3 id="successModalTitle" class="mb-2 font-semibold tracking-wide text-gray-950 dark:text-gray-100">
                    {{ $title }}
                </h3>
                <p>{{ $message }}</p>
            </div>
            <!-- Dialog Footer -->
            <div class="flex items-center justify-center gap-2 border-gray-500 p-4 dark:border-gray-500">
                {{ $modalFooter }}
            </div>
        </div>
    </div>
</div>
