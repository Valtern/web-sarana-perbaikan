<div wire:poll.5s>
<div class="mb-6 border border-gray-300 dark:border-neutral-700 rounded-lg bg-white dark:bg-neutral-900 p-4">
  <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200 mb-4">Search & Filter Reports</h2>
  <div class="flex flex-col sm:flex-row gap-4 sm:items-end">
    <div class="flex-1">
      <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Search by Name</label>
      <input type="text" wire:model.debounce.500ms="searchTerm" class="mt-1 block w-150 rounded-md  border-gray-300 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white" placeholder="Enter name...">
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Start Date</label>
      <input type="date" wire:model="startDate" class="mt-1 block w-full rounded-md  border-gray-300 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white">
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300">End Date</label>
      <input type="date" wire:model="endDate" class="mt-1 block w-full rounded-md  border-gray-300 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white">
    </div>
  </div>
</div>


  <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-neutral-700">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
      <thead class="bg-gray-50 dark:bg-neutral-900">
        <tr>
          <th class="ps-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">#</th>
          <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Reporter</th>
          <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Facility</th>
          <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Location</th>
          <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Category</th>
          <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Status</th>
          <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Reported At</th>
          <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Description</th>
          <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Proof</th>
          <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
        @foreach($reports as $index => $report)
        <tr>
          <td class="ps-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
          <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ $report->reporter_name }}</td>
          <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ $report->facility_name }}</td>
          <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ $report->location }}</td>
          <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ $report->category }}</td>
 <td class="px-6 py-3 text-sm">
  @php
    $statusColors = [
      'Pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
      'Declined' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
      'In_progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
      'Solved' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
    ];
  @endphp

  <div class="flex items-center gap-2">
    <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $statusColors[$report->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200' }}">
      {{ Str::headline(str_replace('_', ' ', $report->status)) }}
    </span>

    <select wire:change="updateStatus({{ $report->report_ID }}, $event.target.value)"
            class="text-xs rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white">
      <option value="" disabled selected hidden>Change</option>
      @foreach(['Pending', 'In_progress', 'Solved', 'Declined'] as $status)
        @if ($report->status !== $status)
          <option value="{{ $status }}">
            {{ Str::headline(str_replace('_', ' ', $status)) }}
          </option>
        @endif
      @endforeach
    </select>
  </div>
</td>


          <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">
            {{ \Carbon\Carbon::parse($report->created_at)->format('d M, H:i') }}
          </td>
          <td class="px-6 py-3">
            <button type="button" onclick="openDescriptionModal(@js($report->description))"
              class="inline-flex items-center gap-x-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 px-3 py-1.5 dark:bg-gray-700 dark:text-white hover:underline">
              View
            </button>
          </td>
          <td class="px-6 py-3">
            @if($report->picture_proof)
              <button type="button" onclick="openProofModal(@js(url($report->picture_proof)))"
                class="inline-flex items-center gap-x-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 px-3 py-1.5 dark:bg-blue-500/10 dark:text-blue-500 hover:underline">
                View Proof
              </button>
            @else
              <span class="text-xs text-gray-400 italic">No image</span>
            @endif
          </td>
          <td class="px-6 py-3 text-sm">
  <button wire:click="deleteReport({{ $report->report_ID }})"
          onclick="return confirm('Are you sure you want to delete this report?')"
          class="text-xs font-medium rounded-full bg-red-100 text-red-800 px-3 py-1.5 dark:bg-red-900 dark:text-red-200 hover:underline">
    Delete
  </button>
         </td>


        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Image Modal -->
  <div id="proofModal" class="fixed hidden inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
    <div class="relative">
      <button onclick="closeProofModal()" class="absolute top-0 right-0 m-4 text-white text-2xl">&times;</button>
      <img id="proofImage" class="max-w-full max-h-[90vh] rounded-lg" src="" alt="Proof Image">
    </div>
  </div>

  <!-- Description Modal -->
  <div id="descriptionModal" class="fixed hidden inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-neutral-800 rounded-xl p-6 max-w-md mx-auto shadow-xl relative">
      <button onclick="closeDescriptionModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-xl">&times;</button>
      <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Report Description</h3>
      <p id="descriptionText" class="text-gray-700 dark:text-gray-300 whitespace-pre-line"></p>
    </div>
  </div>

  <script>
    function openProofModal(imageUrl) {
      document.getElementById('proofImage').src = imageUrl;
      document.getElementById('proofModal').classList.remove('hidden');
    }

    function closeProofModal() {
      document.getElementById('proofImage').src = '';
      document.getElementById('proofModal').classList.add('hidden');
    }

    function openDescriptionModal(description) {
      document.getElementById('descriptionText').innerText = description || 'No description provided.';
      document.getElementById('descriptionModal').classList.remove('hidden');
    }

    function closeDescriptionModal() {
      document.getElementById('descriptionText').innerText = '';
      document.getElementById('descriptionModal').classList.add('hidden');
    }
  </script>
</div>
