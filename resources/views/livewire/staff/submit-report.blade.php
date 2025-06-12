<div>
  @error('facility_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
  @error('category') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
  @error('picture_proof') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
  @error('weight') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

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
      <div class="relative mt-1">
        <select
          wire:model.defer="category"
          id="category"
          required
data-hs-select='{
  "placeholder": "Select Category",
  "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
  "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-neutral-900 dark:border-neutral-700",
  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
  "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>"
}'

          class="w-full"
        >
          <option value="">Select Category</option>
          <option value="Electronic">Electronic</option>
          <option value="Table">Table</option>
          <option value="Chair">Chair</option>
          <option value="Desk">Desk</option>
          <option value="Computer">Computer</option>
          <option value="Miscellaneous">Miscellaneous</option>
        </select>

        <div class="absolute top-1/2 end-2.5 -translate-y-1/2">
          <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m7 15 5 5 5-5"></path>
            <path d="m7 9 5-5 5 5"></path>
          </svg>
        </div>
      </div>
    </div>


    <div>
      <label for="description" class="sr-only">Details</label>
      <textarea wire:model.defer="description" id="description" rows="4"
                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                placeholder="Details"></textarea>
    </div>

    <!-- ✅ Weight Criteria Checkboxes -->
    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-neutral-400 mb-1">Criteria (Weight)</label>
      <div class="grid gap-2 sm:grid-cols-2">
        @foreach([
          'Severity of Damage',
          'Impact on Academic Activities',
          'Frequency of Facility Usage',
          'Estimated Repair Time',
          'Estimated Repair Cost',
          'Urgency Level'
        ] as $option)
          <label class="inline-flex items-center space-x-2">
            <input type="checkbox" wire:model.defer="weight" value="{{ $option }}"
                   class="rounded text-blue-600 border-gray-300 dark:bg-neutral-900 dark:border-neutral-700">
            <span class="text-sm text-gray-700 dark:text-neutral-400">{{ $option }}</span>
          </label>
        @endforeach
      </div>
    </div>

     <div class="space-y-2">
          <label for="af-submit-app-upload-images" class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-neutral-200">
            Preview image
          </label>

          <label for="af-submit-app-upload-images" class="group p-4 sm:p-7 block cursor-pointer text-center border-2 border-dashed border-gray-200 rounded-lg focus-within:outline-hidden focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 dark:border-neutral-700">
            <input id="af-submit-app-upload-images" name="af-submit-app-upload-images" type="file" wire:model="picture_proof" class="sr-only">

            @if ($picture_proof)
              <img src="{{ $picture_proof->temporaryUrl() }}" class="mx-auto rounded-lg object-cover max-h-48" alt="Preview">
            @else
              <svg class="size-10 mx-auto text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
              </svg>
              <span class="mt-2 block text-sm text-gray-800 dark:text-neutral-200">
                Browse your device or <span class="group-hover:text-blue-700 text-blue-600">drag 'n drop'</span>
              </span>
              <span class="mt-1 block text-xs text-gray-500 dark:text-neutral-500">
                Maximum file size is 2 MB
              </span>
            @endif
          </label>
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
