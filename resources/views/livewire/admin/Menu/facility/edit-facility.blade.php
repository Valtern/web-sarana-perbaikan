<div>
    <div class="max-w-xl mx-auto p-6 bg-white dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">

    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Edit Facility Data</h2>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-6">
        <div>
            <label for="facility_ID" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Facility ID</label>
            <input type="number" id="facility_ID" wire:model.defer="facility_ID"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                disabled />
            @error('facility_ID') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Facility Name</label>
            <input type="text" id="name" wire:model.defer="name"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300" />
            @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="type" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Type</label>
            <select id="type" wire:model.defer="type"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300">
                <option value="">-- Select Type --</option>
                @foreach ($types as $t)
                    <option value="{{ $t }}">{{ $t }}</option>
                @endforeach
            </select>
            @error('type') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="building_ID" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Building</label>
            <select id="building_ID" wire:model.defer="building_ID"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300">
                <option value="">-- Select Building --</option>
                @foreach ($buildings as $building)
                    <option value="{{ $building->building_ID }}">{{ $building->name }}</option>
                @endforeach
            </select>
            @error('building_ID') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="status" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Status</label>
            <select id="status" wire:model.defer="status"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300">
                <option value="">-- Select Status --</option>
                @foreach ($statuses as $s)
                    <option value="{{ $s }}">{{ $s }}</option>
                @endforeach
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

</div>
