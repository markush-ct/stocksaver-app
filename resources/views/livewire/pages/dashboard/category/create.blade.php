<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

new #[Layout('layouts.dashboard')] class extends Component {
    #[Validate('required|min:4|max:100')]
    public $name;

    #[Validate('required|min:8|max:200')]
    public $description;

    public function save()
    {
        $validated = $this->validate();

        $category = auth()->user()->categories()->create($validated);

        session()->flash('success', 'You have successfully created a category.');

        return $this->redirectRoute('category.index', [
            'selectedRow' => $category->id,
            'alertType' => 'created',
        ]);
    }
}; ?>

@php
    $breadcrumbsLinks = [
        [
            'label' => 'Categories',
            'routeName' => 'category.index',
        ],
        [
            'label' => 'Create',
        ],
    ]
@endphp

<div>
    <x-slot:breadcrumbs>
        <x-app.breadcrumbs :links="$breadcrumbsLinks" />
    </x-slot:breadcrumbs>

    <div class="flex justify-between items-end text-gray-800 dark:text-gray-300 mb-4">
        <div class="flex flex-col gap-2">
            <h3 class="text-balance text-xl lg:text-2xl font-bold text-gray-950 dark:text-gray-100" aria-describedby="featureDescription">
                Category Form
            </h3>
            <p id="featureDescription" class="text-pretty text-sm">
                Fill up the form to create a category.
            </p>
        </div>
    </div>

    <div class="max-w-lg space-y-4">
        <form wire:submit="save" class="space-y-4">
            <div class="flex w-full flex-col gap-1 text-gray-800 dark:text-gray-300">
                <label for="name" class="w-fit pl-0.5 text-sm">Name</label>
                <input wire:model="name" id="name" type="text" class="w-full rounded-lg border border-gray-500 bg-gray-200 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 disabled:cursor-not-allowed disabled:opacity-75 dark:border-gray-500 dark:bg-gray-800/50 dark:focus-visible:outline-sky-400" name="name" placeholder="Category name" autocomplete="name"/>
                @error('name')<small class="pl-0.5 text-red-500">Error: {{ $message }}</small>@enderror
            </div>

            <div class="flex w-full flex-col gap-1 text-gray-800 dark:text-gray-300">
                <label for="description" class="w-fit pl-0.5 text-sm">Description</label>
                <textarea wire:model="description" id="description" class="w-full rounded-lg border border-gray-500 bg-gray-200 px-2.5 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 disabled:cursor-not-allowed disabled:opacity-75 dark:border-gray-500 dark:bg-gray-800/50 dark:focus-visible:outline-sky-400" rows="3" placeholder="Category description..."></textarea>
                @error('description')<small class="pl-0.5 text-red-500">Error: {{ $message }}</small>@enderror
            </div>

            <div class="space-x-2">
                <x-app.button type="submit">
                    <i class="ph-fill ph-floppy-disk-back text-[18px]"></i>
                    Save
                </x-app.button>

                <button x-on:click="Livewire.navigate('{{ route('category.index') }}')" type="button" class="cursor-pointer whitespace-nowrap rounded-lg px-4 py-2 text-center text-sm font-medium tracking-wide text-gray-800 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 active:opacity-100 active:outline-offset-0 dark:text-gray-300 dark:focus-visible:outline-sky-400">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
