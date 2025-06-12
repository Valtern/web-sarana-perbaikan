<!-- Reach Us Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid Layout -->
  <div class="grid md:grid-cols-2 items-center gap-12">
    
    <!-- Left Column: Info -->
    <div>
  <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white leading-tight mb-6">
    Reach Us
  </h1>

  <img class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg transition-transform hover:scale-105 duration-300"
       src="https://images.unsplash.com/photo-1730791981231-f0a0c584da3e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTA4fHxkaXNjdXNzaW5nfGVufDB8fDB8fHww"
       alt="Hero Image">

  <p class="mt-6 text-lg text-gray-700 dark:text-neutral-200 max-w-2xl mx-auto">
    We provide experiences by turning big ideas into reality, and your feedback helps us do it even better.
  </p>

  <div class="mt-10 text-left">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-100 mb-4">
      What can we offer?
    </h2>

    <ul class="space-y-4">
      @foreach ([
        'Industry-leading design',
        'Developer community support',
        'Simple and affordable'
      ] as $item)
        <li class="flex items-start gap-3">
          <svg class="w-6 h-6 text-green-500 mt-1" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
          <span class="text-gray-600 dark:text-neutral-300 text-base">{{ $item }}</span>
        </li>
      @endforeach
    </ul>
  </div>
</div>

    <!-- End Left Column -->

    <!-- Right Column: Feedback Form -->
<div class="relative">
  <div class="flex flex-col border bg-white dark:bg-neutral-800 border-gray-200 dark:border-neutral-700 rounded-xl p-4 sm:p-6 lg:p-10">
    
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
      Fill in the form
    </h2>

    <form wire:submit.prevent="submit" class="mt-6 grid gap-6">
      
      <!-- Repair ID Dropdown -->
      <div>
        <label for="repairs_ID" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
          Repair ID
        </label>
        <select wire:model="repairs_ID" id="repairs_ID"
                class="py-3 px-4 pe-9 block w-full border border-gray-200 dark:border-neutral-700 rounded-lg text-sm
                       bg-white dark:bg-neutral-900 text-gray-900 dark:text-neutral-300
                       placeholder-gray-400 dark:placeholder-neutral-500
                       focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-neutral-600">
          <option value="">Select Repair ID</option>
          @foreach($repairOptions as $repair)
            <option value="{{ $repair->repair_ID }}">{{ $repair->repair_ID }}</option>
          @endforeach
        </select>
        @error('repairs_ID') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <!-- Rating Input -->
      <div>
        <label for="rate" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
          Rating (1–5)
        </label>
        <input type="number" id="rate" wire:model="rate" min="1" max="5"
               class="py-3 px-4 block w-full border border-gray-200 dark:border-neutral-700 rounded-lg text-sm
                      bg-white dark:bg-neutral-900 text-gray-900 dark:text-neutral-300
                      placeholder-gray-400 dark:placeholder-neutral-500
                      focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-neutral-600">
        @error('rate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <!-- Feedback Textarea -->
      <div>
        <label for="feedback_content" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
          Your Feedback
        </label>
        <textarea id="feedback_content" wire:model="feedback_content" rows="4"
                  class="py-3 px-4 block w-full border border-gray-200 dark:border-neutral-700 rounded-lg text-sm
                         bg-white dark:bg-neutral-900 text-gray-900 dark:text-neutral-300
                         placeholder-gray-400 dark:placeholder-neutral-500
                         focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-neutral-600"></textarea>
        @error('feedback_content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit"
                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2
                       text-sm font-medium rounded-lg border border-transparent
                       bg-blue-600 text-white hover:bg-blue-700
                       focus:outline-none focus:ring-2 focus:ring-blue-500
                       disabled:opacity-50 disabled:pointer-events-none">
          Submit Feedback
        </button>
      </div>

      <!-- Optional Message -->
      <div class="text-center">
        <p class="text-sm text-gray-500 dark:text-neutral-400">
          We'll get back to you in 1–2 business days.
        </p>
      </div>

      <!-- Success Message -->
      @if (session()->has('success'))
        <div class="mt-4 bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 p-3 rounded">
          {{ session('success') }}
        </div>
      @endif

    </form>
  </div>
</div>


  </div>
</div>
<!-- End Reach Us Section -->
