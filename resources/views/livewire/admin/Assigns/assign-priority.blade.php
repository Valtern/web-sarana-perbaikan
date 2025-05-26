<div class="min-h-screen flex items-center justify-center px-4 py-10">
  <div class="w-full max-w-3xl bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl p-6 sm:p-10 shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200 mb-6">
      Fill in the form
    </h2>

    <form wire:submit.prevent="submit" class="space-y-6">
      <!-- Mode Switch -->
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white">Select Mode:</label>
        <select wire:model="mode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
<option value="criteria">Criteria</option>
<option value="alternative">Alternative</option>
<option value="sample">Sample Matrix</option>

        </select>
      </div>

      <!-- Number of Inputs -->
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white">Number of {{ ucfirst($mode) }} to Add:</label>
        <input type="number" min="1" wire:model="numberOfInputs" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" />
        <button type="button" wire:click="updateFieldCount" class="mt-2 py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Generate Fields</button>
      </div>

      <!-- Dynamic Inputs -->
      <div class="space-y-4">
        @if ($mode === 'criteria')
          @foreach ($criteriaInputs as $index => $input)
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div>
                <label class="text-sm text-gray-700 dark:text-white">Name</label>
                <input type="text" wire:model="criteriaInputs.{{ $index }}.criteria_name" class="block w-full rounded-md border-gray-300 shadow-sm sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" />
              </div>
              <div>
                <label class="text-sm text-gray-700 dark:text-white">Weight</label>
                <input type="number" wire:model="criteriaInputs.{{ $index }}.weight" class="block w-full rounded-md border-gray-300 shadow-sm sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" />
              </div>
              <div>
                <label class="text-sm text-gray-700 dark:text-white">Type</label>
                <select wire:model="criteriaInputs.{{ $index }}.type" class="block w-full rounded-md border-gray-300 shadow-sm sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                  <option value="max">Max</option>
                  <option value="min">Min</option>
                </select>
              </div>
            </div>
          @endforeach
        @else
          @foreach ($alternativeInputs as $index => $input)
            <div>
              <label class="text-sm text-gray-700 dark:text-white">Alternative</label>
              <input type="text" wire:model="alternativeInputs.{{ $index }}.alternative" class="block w-full rounded-md border-gray-300 shadow-sm sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" />
            </div>
          @endforeach
        @endif
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Submit</button>
      </div>

      <!-- Success Message -->
      @if (session()->has('message'))
        <div class="text-green-600 dark:text-green-400 text-sm">
          {{ session('message') }}
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


    @livewire('admin.t-o-p-s-i-s-calculation')
  </div>

</div>
