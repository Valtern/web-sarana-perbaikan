<div wire:poll.5s>
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
                  History
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                  List of submitted reports with status, time, and proof for each facility issue.
                </p>
              </div>
            </div>

            <!-- Table -->
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
              <thead class="bg-gray-50 dark:bg-neutral-900">
                <tr>
                  <th class="ps-6 py-3 text-start">
                    <label class="flex">
                      <input type="checkbox" class="shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                      <span class="sr-only">Checkbox</span>
                    </label>
                  </th>
                  <th class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Facility Name</span>
                    </div>
                  </th>
                  <th class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Description</span>
                    </div>
                  </th>
                  <th class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Weight</span>
                    </div>
                  </th>
                  <th class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Created</span>
                    </div>
                  </th>
                  <th class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Proof</span>
                    </div>
                  </th>
                  <th class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Status</span>
                    </div>
                  </th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($reports as $report)
                <tr>
                  <td class="size-px whitespace-nowrap">
                    <div class="ps-6 py-3">
                      <label class="flex">
                        <input type="checkbox" class="shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                        <span class="sr-only">Checkbox</span>
                      </label>
                    </div>
                  </td>
                  <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ $report->facility_name }}</td>
                  <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ $report->description }}</td>
                  <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">
                    {{ is_array($report->weight) ? implode(', ', $report->weight) : 'N/A' }}
                  </td>
                  <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ $report->created_at->format('d M, H:i') }}</td>
                   <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">
                    @if ($report->picture_proof)
                        <a href="{{ Storage::url($report->picture_proof) }}" target="_blank">
                            <img src="{{ Storage::url($report->picture_proof) }}" alt="Proof" class="w-16 h-16 object-cover rounded-md border">
                        </a>
                    @else
                        <span class="italic text-gray-400">No proof</span>
                    @endif
                </td>
                  <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">
                    {{ $report->status }}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
