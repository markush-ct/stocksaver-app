<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Category;

new #[Layout('layouts.dashboard')] class extends Component
{
    use WithPagination;

    public function with()
    {
        return [
            'categories' => Category::latest()->paginate(10),
        ];
    }
}; ?>

<div>
    <div class="flex justify-between items-end text-gray-800 dark:text-gray-300 mb-4">
        <div class="flex flex-col gap-2">
            <h3 class="text-balance text-xl lg:text-2xl font-bold text-gray-950 dark:text-gray-100" aria-describedby="featureDescription">
                Categories List
            </h3>
            <p id="featureDescription" class="text-pretty text-sm">
                Here's a list of categories.
            </p>
        </div>

        <div>
            <x-app.button x-on:click="Livewire.navigate('{{ route('category.create') }}')">
                <i class="ph-fill ph-plus-circle text-[20px]"></i>
                Create new
            </x-app.button>
        </div>
    </div>

    @session('success')
        <!-- success Alert -->
        <div x-data="{showAlert: true}" x-show="showAlert" class="relative w-full overflow-hidden rounded-lg border border-green-500 bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-300 mb-4" role="alert">
            <div class="flex w-full items-center gap-2 bg-green-500/10 p-4">
                <div class="bg-green-500/15 text-green-500 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <h3 class="text-sm font-semibold text-green-500">Successfully Created</h3>
                    <p class="text-xs font-medium sm:text-sm">Success! {{ $value }}</p>
                </div>
                <button class="ml-auto" aria-label="dismiss alert" x-on:click="showAlert = false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endsession

    <div x-data="{ checkAll : false }" class="overflow-hidden w-full overflow-x-auto rounded-lg border border-gray-500 dark:border-gray-500">
        <table class="w-full text-left text-sm text-gray-800 dark:text-gray-300">
            <thead class="border-b border-gray-500 bg-gray-200 text-sm text-gray-950 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-100">
                <tr>
                    <th scope="col" class="p-4">
                        <label for="checkAll" class="flex items-center cursor-pointer text-gray-800 dark:text-gray-300 ">
                            <div class="relative flex items-center">
                                <input type="checkbox" x-model="checkAll" id="checkAll" class="before:content[''] peer relative size-4 cursor-pointer appearance-none overflow-hidden rounded border border-gray-500 bg-gray-50 before:absolute before:inset-0 checked:border-sky-900 checked:before:bg-sky-900 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-gray-900 checked:focus:outline-sky-900 active:outline-offset-0 dark:border-gray-500 dark:bg-gray-800 dark:checked:border-sky-400 dark:checked:before:bg-sky-400 dark:focus:outline-gray-300 dark:checked:focus:outline-sky-400" />
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="4" class="pointer-events-none invisible absolute left-1/2 top-1/2 size-3 -translate-x-1/2 -translate-y-1/2 text-white peer-checked:visible dark:text-black">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                </svg>
                            </div>
                        </label>
                    </th>
                    <th scope="col" class="p-4">Name</th>
                    <th scope="col" class="p-4">Description</th>
                    <th scope="col" class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-500 dark:divide-gray-500">
                @foreach ($categories as $category)
                    <tr wire:key="{{ $category->id }}">
                        <td class="p-4">
                            <label for="{{ $category->id }}" class="flex items-center cursor-pointer text-gray-800 dark:text-gray-300 ">
                                <div class="relative flex items-center">
                                    <input type="checkbox" id="{{ $category->id }}" class="before:content[''] peer relative size-4 cursor-pointer appearance-none overflow-hidden rounded border border-gray-500 bg-gray-50 before:absolute before:inset-0 checked:border-sky-900 checked:before:bg-sky-900 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-gray-900 checked:focus:outline-sky-900 active:outline-offset-0 dark:border-gray-500 dark:bg-gray-800 dark:checked:border-sky-400 dark:checked:before:bg-sky-400 dark:focus:outline-gray-300 dark:checked:focus:outline-sky-400" :checked="checkAll" />
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="4" class="pointer-events-none invisible absolute left-1/2 top-1/2 size-3 -translate-x-1/2 -translate-y-1/2 text-white peer-checked:visible dark:text-black">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                    </svg>
                                </div>
                            </label>
                        </td>
                        <td class="p-4">
                            <div class="max-w-[250px] truncate">
                                {{ $category->name }}
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="max-w-[500px] truncate">
                                {{ $category->description }}
                            </div>
                        </td>
                        <td class="p-4">
                            <button x-on:click="Livewire.navigate('{{ route('category.edit', $category->id) }}')" type="button" class="cursor-pointer whitespace-nowrap rounded-lg bg-transparent p-0.5 font-semibold text-sky-900 outline-sky-900 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-sky-400 dark:outline-sky-400">
                                Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
