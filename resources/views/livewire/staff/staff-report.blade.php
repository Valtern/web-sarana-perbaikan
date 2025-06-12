<div>
  <!-- Contact Us -->
  <div class="w-full px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
    <div class="max-w-2xl lg:max-w-5xl mx-auto">

      <!-- Form Title -->
      <div class="text-center mb-10">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
          Fill in the Report Form
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
          Please provide accurate information for facility reporting
        </p>
      </div>
      
      <!-- Form Card -->
      <div class="w-257 bg-white rounded-xl shadow-xs dark:bg-neutral-900">
        <!-- Header with background image -->
        <div class="relative h-40 rounded-t-xl bg-blue-600 bg-[url('https://preline.co/assets/svg/examples/abstract-1.svg')] bg-no-repeat bg-cover bg-center">
          <div class="absolute top-0 end-0 p-4">
            <!-- Optional: Add action buttons here -->
          </div>
        </div>

        <!-- Card Body -->
        <div class="pt-0 p-4 sm:pt-0 sm:p-7">
          <!-- User Image and Project Title -->
          <div class="space-y-4 sm:space-y-6">
            <div>
              <label class="sr-only">Product photo</label>
              <div class="flex flex-col sm:flex-row sm:items-center sm:gap-x-5">
                <!-- Foto Profil -->
                <img
                  class="-mt-8 relative z-10 inline-block size-24 mx-auto sm:mx-0 rounded-full ring-4 ring-white dark:ring-neutral-900 object-cover aspect-square"
                  src="{{ $user->profile_picture_url }}"
                  alt="Avatar"
                />

                <!-- Informasi User -->
                <div class="mt-4 sm:mt-0 flex flex-col text-center sm:text-left">
                  <p class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ $user->name }}
                  </p>
                  <p class="text-sm text-gray-600 dark:text-neutral-400">
                    {{ $user->email }}
                  </p>
                </div>
              </div>
            </div>

            <div class="space-y-2">
              <label for="af-submit-app-project-name" class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-neutral-200">
                Project Name
              </label>

              <!-- Livewire Report Form -->
              @livewire('staff.submit-report')
            </div>
          </div>
        </div>
      </div>
      <!-- End Form Card -->

      <!-- Report History Section -->
      <div class="mt-12">
  <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
    Report History
  </h2>

  <div class="max-w-2xl lg:max-w-5xl mx-auto">
    @livewire('staff.report-history')
  </div>
</div>
    </div>
  </div>
</div>
