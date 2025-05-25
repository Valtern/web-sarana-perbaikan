<div>

  @error('facility_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
  @error('category') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
  @error('picture_proof') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

  <form wire:submit.prevent="submit" enctype="multipart/form-data" class="grid gap-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label for="facility_name" class="sr-only">Facility Name</label>
        <input type="text" wire:model.defer="facility_name" id="facility_name"
               class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
               placeholder="Facility Name" required>
      </div>

      <div>
        <label for="location" class="sr-only">Location</label>
        <input type="text" wire:model.defer="location" id="location"
               class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
               placeholder="Location">
      </div>
    </div>

    <div>
      <label for="category" class="sr-only">Category</label>
      <select wire:model.defer="category" id="category"
              class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm text-gray-700 focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600"
              required>
        <option value="">Select Category</option>
        <option value="Electronic">Electronic</option>
        <option value="Table">Table</option>
        <option value="Chair">Chair</option>
        <option value="Desk">Desk</option>
        <option value="Computer">Computer</option>
        <option value="Miscellaneous">Miscellaneous</option>
      </select>
    </div>

    <div>
      <label for="description" class="sr-only">Details</label>
      <textarea wire:model.defer="description" id="description" rows="4"
                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                placeholder="Details"></textarea>
    </div>

    <div>
      <label for="picture_proof" class="block text-sm font-medium text-gray-700 dark:text-neutral-400 mb-1">Upload Image</label>
      <input type="file" wire:model="picture_proof" id="picture_proof"
             class="block w-full text-sm text-gray-700 dark:text-neutral-400 border border-gray-200 rounded-lg px-3 py-2 file:bg-transparent file:border-0 file:text-sm file:text-gray-500 file:dark:text-neutral-500 dark:bg-neutral-900 dark:border-neutral-700">
    </div>

    <div class="mt-4 grid">
      <button type="submit"
              class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
        Send inquiry
      </button>
    </div>

    <div class="mt-3 text-center">
      <p class="text-sm text-gray-500 dark:text-neutral-500">We'll get back to you in 1–2 business days.</p>
    </div>
  </form>
</div>
