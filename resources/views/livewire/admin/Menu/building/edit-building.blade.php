<div class="max-w-xl mx-auto p-6 bg-white dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">
    
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Edit Building Data</h2>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-6">
        <div>
            <label for="building_ID" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Building ID</label>
            <input type="number" id="building_ID" wire:model.defer="building_ID"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                disabled />
            @error('building_ID') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Building Name</label>
            <input type="text" id="name" wire:model.defer="name"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300" />
            @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="location" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Location</label>
            <input type="text" id="location" wire:model.defer="location"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300" />
            @error('location') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="status" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Status</label>
            <select id="status" wire:model.defer="status"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300">
                <option value="Good">Good</option>
                <option value="Fine">Fine</option>
                <option value="Damaged">Damaged</option>
            </select>
            @error('status') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit"
                class="w-full py-3 px-4 font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-200">
                Update
            </button>
        </div>
    </form>
</div>
