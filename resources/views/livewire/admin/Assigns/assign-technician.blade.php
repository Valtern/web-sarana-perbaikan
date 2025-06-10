<div>
<!-- Card Section -->
<div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <form wire:submit.prevent="store">
    <!-- Card -->
    <div class="bg-white rounded-xl shadow-xs dark:bg-neutral-900">
      <!-- Header Image -->
      <div class="relative h-40 rounded-t-xl bg-blue-600 bg-[url('https://preline.co/assets/svg/examples/abstract-1.svg')] bg-no-repeat bg-cover bg-center">
    
      </div>

      <!-- Card Content -->
      <div class="mt-5 p-4 sm:mt-4 sm:p-7">
        <div class="text-center mb-8">
          <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-neutral-200">Assign Technician</h2>
          <p class="text-sm text-gray-600 dark:text-neutral-400">Select the facility report and the technician to be assigned.</p>
        </div>

        <!-- Form Grid -->
        <div class="space-y-6 sm:space-y-7">
          <!-- Facility Report Select -->
          <div>
            <label for="facility_report" class="inline-block text-sm font-medium text-gray-800 dark:text-white">Choose Reports Facilities</label>
            <select id="facility_report" wire:model="facility_report_id" class="mt-2 block w-full py-1.5 sm:py-2 px-3 pe-9 border border-gray-200 rounded-lg shadow-2xs sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
              <option value="">Choose Reports</option>
              @foreach ($reports as $report)
                <option value="{{ $report->report_ID }}">{{ $report->report_ID }}</option>
              @endforeach
            </select>
          </div>

          <!-- Technician Select -->
          <div>
            <label for="technician_select" class="inline-block text-sm font-medium text-gray-800 dark:text-white">Choose the technician</label>
            <select id="technician_select" wire:model="technician_id" class="mt-2 block w-full py-1.5 sm:py-2 px-3 pe-9 border border-gray-200 rounded-lg shadow-2xs sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
              <option>Choose Technician</option>
              @foreach ($technicians as $tech)
                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
              @endforeach
            </select>
          </div>

          <!-- Notes Textarea -->
          <div>
            <label for="notes" class="inline-block text-sm font-medium text-gray-800 dark:text-white">Notes</label>
            <textarea id="notes" wire:model="notes" rows="3" class="mt-2 block w-full border border-gray-200 rounded-lg shadow-2xs sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"></textarea>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 flex justify-end gap-x-2">
          <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            {{ $editRepairId ? 'Update' : 'Assign' }}
          </button>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </form>
</div>
<!-- End Card Section -->




    <!-- Divider -->
    <hr class="my-4">

    <!-- Table Repair List -->
    <div>
        <div>
  <!-- Table Section -->
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
                <!-- Header -->
                <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                    <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Repairs
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                            The Repairs will show here on the table.
                    </p>
                    </div>

                </div>
                <!-- End Header -->

        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 text-sm">
    <thead class="bg-gray-50 dark:bg-neutral-900">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200 border-b border-gray-200 dark:border-neutral-700">id</th>
        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200 border-b border-gray-200 dark:border-neutral-700">Report</th>
        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200 border-b border-gray-200 dark:border-neutral-700">Technician</th>
        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200 border-b border-gray-200 dark:border-neutral-700">Status</th>
        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200 border-b border-gray-200 dark:border-neutral-700">Notes</th>
        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200 border-b border-gray-200 dark:border-neutral-700">Action</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
      @forelse ($repairs as $repair)
      <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800">
        <td class="px-6 py-3 whitespace-nowrap text-gray-600 dark:text-neutral-400">{{ $repair->repair_ID }}</td>
        <td class="px-6 py-3 whitespace-nowrap text-gray-600 dark:text-neutral-400">{{ $repair->facility_report_id }}</td>
        <td class="px-6 py-3 whitespace-nowrap text-gray-600 dark:text-neutral-400">{{ $repair->technician->name ?? '-' }}</td>
        <td class="px-6 py-3 whitespace-nowrap text-gray-600 dark:text-neutral-400">{{ $repair->repair_status }}</td>
        <td class="px-6 py-3 whitespace-nowrap text-gray-600 dark:text-neutral-400">{{ $repair->notes ?? '-' }}</td>

        <td class="px-6 py-3 whitespace-nowrap space-x-2">
         
          <button wire:click="delete({{ $repair->repair_ID }})" onclick="confirm('Are you sure you want to delete this building?') || event.stopImmediatePropagation()" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-hidden focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:bg-red-800/30 dark:hover:bg-red-800/20 dark:focus:bg-red-800/20">
            Delete
          </button>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center py-4 text-gray-500 dark:text-neutral-400">There is no repair data yet</td>
      </tr>
      @endforelse
    </tbody>
  </table>
    

      <!-- Footer -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
            <div>
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                <span class="font-semibold text-gray-800 dark:text-neutral-200">6</span> results
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                  Prev
                </button>

                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                  Next
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>
              </div>
            </div>
          </div>
          <!-- End Footer -->

</div>
 {{ $repairs->links() }}
</div>
