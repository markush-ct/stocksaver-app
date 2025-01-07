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
            <x-app.button>
                <i class="ph-fill ph-plus-circle text-[20px]"></i>
                Create new
            </x-app.button>
        </div>
    </div>

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
                            <label :for="$category->id" class="flex items-center cursor-pointer text-gray-800 dark:text-gray-300 ">
                                <div class="relative flex items-center">
                                    <input type="checkbox" id="user2335" class="before:content[''] peer relative size-4 cursor-pointer appearance-none overflow-hidden rounded border border-gray-500 bg-gray-50 before:absolute before:inset-0 checked:border-sky-900 checked:before:bg-sky-900 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-gray-900 checked:focus:outline-sky-900 active:outline-offset-0 dark:border-gray-500 dark:bg-gray-800 dark:checked:border-sky-400 dark:checked:before:bg-sky-400 dark:focus:outline-gray-300 dark:checked:focus:outline-sky-400" :checked="checkAll" />
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
                            <button type="button" class="cursor-pointer whitespace-nowrap rounded-lg bg-transparent p-0.5 font-semibold text-sky-900 outline-sky-900 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-sky-400 dark:outline-sky-400">
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
