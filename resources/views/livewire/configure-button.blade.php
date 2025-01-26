<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-gray-900 font-bold">{{ 'Shkolo Assignment' }}</h1>
        </div>

        <div class="max-w-lg mx-auto">
            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium mb-1">Button Title</label>
                    <input type="text" id="title" wire:model="title" class="form-input w-full">
                </div>
                <div class="mb-4">
                    <label for="hyperlink" class="block text-sm font-medium mb-1">Hyperlink</label>
                    <input type="url" id="hyperlink" wire:model="hyperlink" class="form-input w-full">
                </div>
                <div class="mb-4">
                    <label for="color" class="block text-sm font-medium mb-1">Button Color</label>
                    <input type="color" id="color" wire:model="color" class="form-input w-full h-10">
                </div>
                <div class="px-5 py-4 flex justify-end space-x-2">
                    <a href="{{ route('assignment') }}" class="btn border-gray-200 hover:border-gray-300 text-gray-800">Cancel</a>
                    <button type="submit" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800" wire:loading.attr="disabled">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>
