<div><!-- Hire Us -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid -->
  <div class="grid md:grid-cols-2 items-center gap-12">
    <div>
      <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl lg:text-5xl lg:leading-tight dark:text-white">
        Reach us
      </h1>
      <p class="mt-1 md:text-lg text-gray-800 dark:text-neutral-200">
        We provide experiences by turning big ideas into realit and your feedback helps us do it even better.
      </p>

      <div class="mt-8">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
          What can we expect?
        </h2>

        <ul class="mt-2 space-y-2">
          <li class="flex gap-x-3">
            <svg class="shrink-0 mt-0.5 size-5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <span class="text-gray-600 dark:text-neutral-400">
              Industry-leading design
            </span>
          </li>

          <li class="flex gap-x-3">
            <svg class="shrink-0 mt-0.5 size-5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <span class="text-gray-600 dark:text-neutral-400">
              Developer community support
            </span>
          </li>

          <li class="flex gap-x-3">
            <svg class="shrink-0 mt-0.5 size-5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <span class="text-gray-600 dark:text-neutral-400">
              Simple and affordable
            </span>
          </li>
        </ul>
      </div>
    
    </div>
    <!-- End Col -->

    <div class="relative">
      <!-- Card -->
      <div class="flex flex-col border border-gray-200 rounded-xl p-4 sm:p-6 lg:p-10 dark:border-neutral-700">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
          Fill in the form
        </h2>

       <form wire:submit.prevent="submit">
  <div class="mt-6 grid gap-4 lg:gap-6">

    <!-- Repair ID and Rating -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
      <div>
        <label for="repairs_ID" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Repair ID</label>
        <input type="text" wire:model="repairs_ID" id="repairs_ID"
               class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm
                      focus:border-blue-500 focus:ring-blue-500
                      disabled:opacity-50 disabled:pointer-events-none
                      dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                      dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        @error('repairs_ID') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label for="rate" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Rating (1–5)</label>
        <input type="number" min="1" max="5" wire:model="rate" id="rate"
               class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm
                      focus:border-blue-500 focus:ring-blue-500
                      disabled:opacity-50 disabled:pointer-events-none
                      dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                      dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        @error('rate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>
    </div>

    <!-- Feedback Text -->
    <div>
      <label for="feedback_content" class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Your Feedback</label>
      <textarea wire:model="feedback_content" id="feedback_content" rows="4"
                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm
                       focus:border-blue-500 focus:ring-blue-500
                       disabled:opacity-50 disabled:pointer-events-none
                       dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                       dark:placeholder-neutral-500 dark:focus:ring-neutral-600"></textarea>
      @error('feedback_content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Submit Button -->
    <div class="mt-6 grid">
          <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Submit Feedback</button>
        </div>

        <div class="mt-3 text-center">
          <p class="text-sm text-gray-500 dark:text-neutral-500">
            We'll get back to you in 1-2 business days.
          </p>
        </div>

    <!-- Success Message -->
    @if (session()->has('success'))
      <div class="mt-4 bg-green-100 text-green-700 p-3 rounded">
        {{ session('success') }}
      </div>
    @endif

  </div>
</form>

        <!-- End Grid -->

    
        <!-- End Checkbox -->

        
      </div>
      <!-- End Card -->
    </div>
    <!-- End Col -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Hire Us --></div>