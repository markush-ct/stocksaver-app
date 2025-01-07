<!-- primary Button -->
<button {{$attributes->merge(['type' => 'button', 'class' => 'cursor-pointer inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-lg bg-sky-900 px-4 py-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-sky-400 dark:text-black dark:focus-visible:outline-sky-400'])}}>
    {{ $slot }}
</button>
