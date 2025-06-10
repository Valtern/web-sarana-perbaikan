<div class="min-h-screen flex items-center justify-center px-4 py-10">
  <div class="w-full @if($mode === 'sample') max-w-7xl @else max-w-3xl @endif bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl p-6 sm:p-10 transition-all duration-300">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200 mb-6">
      Fill in the form
    </h2>

    <form wire:submit.prevent="submit" class="space-y-6">
      <!-- Mode Switch -->
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white">Select Mode:</label>
        <select wire:model="mode" class="mt-1 block w-full rounded-md border-gray-300  focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
<option value="criteria">Criteria</option>
<option value="alternative">Alternative</option>
<option value="sample">Sample Matrix</option>

        </select>
      </div>

      <!-- Number of Inputs -->
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white">
          Number of {{ ucfirst($mode) }} to Add:
        </label>

        <input type="number" min="1" wire:model="numberOfInputs"
              class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" />

        <button type="button" wire:click="updateFieldCount"
                class="mt-4 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
          Generate Fields
        </button>
      </div>


      <!-- Dynamic Inputs -->
      <div class="space-y-4">
        @if ($mode === 'criteria')
          @foreach ($criteriaInputs as $index => $input)
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div>
                <label class="text-sm text-gray-700 dark:text-white">Name</label>
                <input type="text" wire:model="criteriaInputs.{{ $index }}.criteria_name" class="block w-full rounded-md border-gray-300  sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" />
              </div>
              <div>
                <label class="text-sm text-gray-700 dark:text-white">Weight</label>
                <input type="number" wire:model="criteriaInputs.{{ $index }}.weight" class="block w-full rounded-md border-gray-300  sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" />
              </div>
              <div>
                <label class="text-sm text-gray-700 dark:text-white">Type</label>
                <select wire:model="criteriaInputs.{{ $index }}.type" class="block w-full rounded-md border-gray-300  sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                  <option value="max">Max</option>
                  <option value="min">Min</option>
                </select>
              </div>
            </div>
          @endforeach
        @else
@foreach ($alternativeInputs as $index => $input)
  <div class="relative">
    <label class="text-sm text-gray-700 dark:text-white">Search Facility Name</label>
    <input type="text"
        wire:model="reportSearch.{{ $index }}"
        wire:input="searchReports({{ $index }})"
        class="block w-full rounded-md border-gray-300 sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
        placeholder="Search for a facility..." />

    <!-- Dropdown -->
    @if (!empty($reportResults[$index]))
        <ul class="absolute w-full mt-1 z-10 max-h-40 overflow-auto rounded-md bg-white dark:bg-neutral-800 border border-gray-300 shadow">
            @foreach ($reportResults[$index] as $report)
                <li wire:click="selectReport({{ $index }}, {{ $report->report_ID }})"
                    class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-700 cursor-pointer">
                    {{ $report->facility_name }} - {{ $report->report_ID }}
                </li>
            @endforeach
        </ul>
    @endif
  </div>
@endforeach


        @endif
      </div>

<!-- Submit & Clear Buttons -->
<div class="flex justify-between space-x-2">
  <button type="submit" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-100 text-teal-800 hover:bg-teal-200 focus:outline-hidden focus:bg-teal-200 disabled:opacity-50 disabled:pointer-events-none dark:text-teal-500 dark:bg-teal-800/30 dark:hover:bg-teal-800/20 dark:focus:bg-teal-800/20">
    Submit
  </button>
@if ($mode === 'alternative')
  <button type="button"
          wire:click="addAllReportsAsAlternatives"
          class="py-2 px-3 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
    Add All Data from Report
  </button>
@endif

  <button type="button" wire:click="clearAll" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-hidden focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:bg-red-800/30 dark:hover:bg-red-800/20 dark:focus:bg-red-800/20">
    Clear
  </button>
</div>


      <!-- Success Message -->
      @if (session()->has('message'))
        <div class="text-green-600 dark:text-green-400 text-sm">
          {{ session('message') }}
        </div>
      @endif
      @if (session()->has('error'))
    <div class="text-red-600 dark:text-red-400 text-sm mt-2">
        {{ session('error') }}
    </div>
@endif

    </form>
    @if ($mode === 'sample')
    <form wire:submit.prevent="submitSampleValues" class="mt-10 space-y-4">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Fill Sample Matrix</h3>
        <table class="w-full border border-gray-300 dark:border-neutral-600 text-sm">
            <thead>
                <tr class="bg-gray-100 dark:bg-neutral-700 text-left">
                    <th class="p-2">Alternative \ Criteria</th>
                    @foreach ($existingCriteria as $criteria)
                        <th class="p-2">{{ $criteria->criteria_name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($existingAlternatives as $alternative)
                    <tr class="border-t border-gray-200 dark:border-neutral-700">
                        <td class="p-2 font-medium">{{ $alternative->alternative }}</td>
                        @foreach ($existingCriteria as $criteria)
                            <td class="p-2">
                                <input type="number" step="0.01"
                                    wire:model="sampleValues.{{ $alternative->id_alternative }}.{{ $criteria->criteria_topsis_id }}"
                                    class="w-full rounded-md border-gray-300 dark:bg-neutral-800 dark:border-neutral-600 dark:text-white" />
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
            Save Matrix
        </button>
    </form>
@endif


    <!-- TOPSIS Final Rankings -->
<div class="mt-10">
  @livewire('admin.t-o-p-s-i-s-calculation', ['showOnlyFinal' => true])
</div>

<!-- Step-by-Step Button -->
<div class="mt-4 text-center">
  <button
    type="button"
    class="mt-4 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
    aria-haspopup="dialog"
    aria-expanded="false"
    aria-controls="hs-scale-animation-modal"
    data-hs-overlay="#hs-scale-animation-modal"
  >
    View Step-by-Step Calculation
  </button>
</div>

<!-- Modal with Step-by-Step Calculation -->
<div id="hs-scale-animation-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
  <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-4xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
    <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white">
          Step-by-Step TOPSIS Calculation
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400" aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
          </svg>
        </button>
      </div>
      <div class="p-4 overflow-y-auto max-h-[70vh]">
        @livewire('admin.t-o-p-s-i-s-calculation', ['showStepsOnly' => true])
      </div>
      <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
        <button type="button" class="py-2 px-3 inline-flex items-center text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-scale-animation-modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

  </div>

</div>
