<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\Category;

new #[Layout('layouts.dashboard')] class extends Component {
    public Category $category;

    #[Validate('required|min:4|max:100')]
    public $name;

    #[Validate('required|min:8|max:200')]
    public $description;

    public function mount($categoryId = null)
    {
        if ($categoryId) {
            $category = auth()
                ->user()
                ->categories()
                ->findOrFail($categoryId);

            $this->category = $category;
            $this->name = $category->name;
            $this->description = $category->description;
        }
    }

    public function update()
    {
        $validated = $this->validate();

        $this->category->update($validated);

        session()->flash('success', 'You have successfully updated a category.');

        return $this->redirectRoute('category.index', [
            'selectedRow' => $this->category->id,
            'alertType' => 'updated',
        ]);
    }
}; ?>

<div>
    <div class="flex justify-between items-end text-gray-800 dark:text-gray-300 mb-4">
        <div class="flex flex-col gap-2">
            <h3 class="text-balance text-xl lg:text-2xl font-bold text-gray-950 dark:text-gray-100" aria-describedby="featureDescription">
                Update Category
            </h3>
            <p id="featureDescription" class="text-pretty text-sm">
                Fill up the form to update a category.
            </p>
        </div>
    </div>

    <div class="max-w-lg space-y-4">
        <form wire:submit="update" class="space-y-4">
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
                    <i wire:loading.remove class="ph-fill ph-floppy-disk-back text-[18px]"></i>
                    <span wire:loading.remove>Update</span>

                    <svg wire:loading aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-5 animate-spin motion-reduce:animate-none fill-white dark:fill-black" >
                        <path opacity="0.25" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" />
                        <path d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z" />
                    </svg>
                    <span wire:loading>Updating...</span>
                </x-app.button>

                <button x-on:click="Livewire.navigate('{{ route('category.index') }}')" type="button" class="cursor-pointer whitespace-nowrap rounded-lg px-4 py-2 text-center text-sm font-medium tracking-wide text-gray-800 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-900 active:opacity-100 active:outline-offset-0 dark:text-gray-300 dark:focus-visible:outline-sky-400">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
