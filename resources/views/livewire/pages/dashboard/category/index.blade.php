<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

new #[Layout('layouts.dashboard')] class extends Component
{
    use WithPagination;

    #[Url]
    public $search;

    #[Url]
    public $selectedRow;

    #[Url]
    public $alertType;

    public Category $selectedCategory;

    public function view(Category $category)
    {
        Gate::authorize('view', $category);

        $this->selectedCategory = $category;

        $this->dispatch('category-viewed');
    }

    public function delete(Category $category)
    {
        Gate::authorize('delete', $category);

        $this->dispatch('open-alert');

        $this->selectedCategory = $category;
    }

    public function confirmDeletion()
    {
        Gate::authorize('delete', $this->selectedCategory);

        $categoryName = $this->selectedCategory->name;

        $this->selectedCategory->delete();

        $this->dispatch('close-alert');

        $this->dispatch(
            'notify',
            variant: 'success',
            title: 'Success!',
            message: "{$categoryName} have been deleted successfully!",
        );
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function with()
    {
        return [
            'categories' => auth()
                ->user()
                ->categories()
                ->name($this->search)
                ->latest()
                ->paginate(10),
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

    @if (session('success'))
        <!-- success Alert -->
        <div x-data="{showAlert: true}" x-show="showAlert" class="relative w-full overflow-hidden rounded-lg border border-green-500 bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-300 mb-4" role="alert">
            <div class="flex w-full items-center gap-2 bg-green-500/10 p-4">
                <div class="bg-green-500/15 text-green-500 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <h3 class="text-sm font-semibold text-green-500">Successfully {{ $alertType }}</h3>
                    <p class="text-xs font-medium sm:text-sm">Success! {{ session('success') }}</p>
                </div>
                <button class="ml-auto" aria-label="dismiss alert" x-on:click="showAlert = false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Search input -->
    <div class="mb-4">
        <div class="relative flex w-full max-w-xs flex-col gap-1 text-gray-800 dark:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="absolute left-2.5 top-1/2 size-5 -translate-y-1/2 text-gray-800/50 dark:text-gray-300/50">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input wire:model.live.debounce.300ms="search" type="search" class="w-full rounded-lg border border-gray-500 bg-gray-200 py-2 pl-10 pr-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 disabled:cursor-not-allowed disabled:opacity-75 dark:border-gray-500 dark:bg-gray-800/50 dark:focus-visible:outline-sky-400" name="search" placeholder="Search" aria-label="search"/>
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
                    <th scope="col" class="p-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-500 dark:divide-gray-500">
                @forelse ($categories as $category)
                    <tr wire:key="{{ $category->id }}" class='{{ $selectedRow === $category->id ? 'bg-sky-900/10 dark:bg-sky-400/10' : '' }}' wire:target="delete({{ $category->id }})">
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
                            <div class="max-w-[300px] truncate">
                                {{ $category->description }}
                            </div>
                        </td>
                        <td class="p-4 flex flex-row gap-1">
                            <x-app.action-button wire:click="view({{ $category->id }})" wire:loading.attr="disabled" variant="inverse">
                                <x-app.icon-loader wire:target="view({{ $category->id }})" wire:loading.delay.default class="fill-black dark:fill-white" />
                                <i wire:target="view({{ $category->id }})" wire:loading.delay.default.remove class="ph-fill ph-eye text-base"></i>
                                View
                            </x-app.action-button>
                            <x-app.action-button variant="primary" x-on:click="Livewire.navigate('{{ route('category.edit', $category->id) }}')">
                                <i class="ph-fill ph-pencil-simple text-md"></i>
                                Edit
                            </x-app.action-button>
                            <x-app.action-button variant="danger" wire:click="delete({{ $category->id }})">
                                <x-app.icon-loader wire:target="delete({{ $category->id }})" wire:loading.delay.default class="fill-red-500 dark:fill-red-500" />
                                <i wire:target="delete({{ $category->id }})" wire:loading.delay.default.remove class="ph-fill ph-trash-simple text-md"></i>
                                Delete
                            </x-app.action-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center h-[100px]">
                            No categories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

    <!-- Modal -->
    <x-app.modal x-on:category-viewed.window="modalIsOpen = true">
        <x-slot:modal-header>{{ str($selectedCategory->name ?? '')->words(8) }}</x-slot:modal-header>
        <x-slot:modal-body>
            <div class="space-y-4">
                <div class="grid max-sm:grid-cols-1 grid-cols-12 gap-1">
                    <div class="col-span-4 font-semibold">
                        Name
                    </div>
                    <div class="col-span-8">
                        {{ $selectedCategory->name ?? '' }}
                    </div>
                </div>
                <div class="grid max-sm:grid-cols-1 grid-cols-12 gap-1">
                    <div class="col-span-4 font-semibold">
                        Description
                    </div>
                    <div class="col-span-8">
                        {{ $selectedCategory->description ?? '' }}
                    </div>
                </div>
            </div>
        </x-slot:modal-body>
        <x-slot:modal-footer>
            <x-app.button x-on:click="Livewire.navigate('{{ route('category.edit', $selectedCategory->id ?? '') }}')">
                <i class="ph-fill ph-pencil-simple text-lg"></i>
                Edit
            </x-app.button>
        </x-slot:modal-footer>
    </x-app.modal>

    <x-app.modal-alert
        x-on:open-alert.window="modalIsOpen = true"
        x-on:close-alert.window="modalIsOpen = false"
        variant="danger"
        title="Delete {{ str($selectedCategory->name ?? '')->words(4) }}"
        message="Are you sure you would like to do this?"
        isForDeletion=true
    >
        <x-slot:modal-footer>
            <x-app.button x-on:click="modalIsOpen = false" class="w-full" variant="alternate">
                Cancel
            </x-app.button>
            <x-app.button wire:loading.attr="disabled" wire:click="confirmDeletion()" class="w-full" variant="danger">
                <x-app.icon-loader wire:target="confirmDeletion()" wire:loading.delay.default />
                Confirm
            </x-app.button>
        </x-slot:modal-footer>
    </x-app.modal-alert>
</div>
