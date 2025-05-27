@php
$statusLabels = [
    'Not_started' => 'Not Started',
    'In_progress' => 'In Progress',
    'Completed' => 'Completed',
];
@endphp

<div>
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
<!-- Table Header -->
<thead class="bg-gray-50 dark:bg-neutral-900">
  <tr>
    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Facility Name</th>
    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Location</th>
    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Description</th>
    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Proof</th>
    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Priority</th>
    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Notes</th>
    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Repair Status</th>
    <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Action</th>
  </tr>
</thead>

<!-- Table Body -->
<div>
<tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
  @foreach($repairs as $repair)
  <tr>
    <td class="px-6 py-3 text-sm text-gray-800 dark:text-neutral-200">{{ $repair->report->facility_name }}</td>
    <td class="px-6 py-3 text-sm text-gray-800 dark:text-neutral-200">{{ $repair->report->location }}</td>
<td class="px-6 py-3 text-sm text-gray-800 dark:text-neutral-200">
  @if($repair->report->description)
    <button
      onclick="showDescription(@js($repair->report->description))"
      class="py-2 px-3 inline-flex items-center gap-x-2 text-xs rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
      View
    </button>
  @else
    <span class="text-xs text-gray-400 italic">No description</span>
  @endif
</td>

<td class="px-6 py-3">
  @if($repair->report && $repair->report->picture_proof)
    <button
      type="button"
      onclick="openModal(@js(asset($repair->report->picture_proof)))"
      class="py-2 px-3 inline-flex items-center gap-x-2 text-xs rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
      View Proof
    </button>
  @else
    <span class="text-xs text-gray-400 italic">No image</span>
  @endif
</td>
    <td class="px-6 py-3 text-sm text-gray-800 dark:text-neutral-200">
      {{ $repair->priority_Assignment ?? 'N/A' }}
    </td>
<td class="px-6 py-3 text-sm text-gray-800 dark:text-neutral-200">
  @if($repair->notes)
    <button
      onclick="showNotes(@js($repair->notes))"
      class="py-2 px-3 inline-flex items-center gap-x-2 text-xs rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
      View
    </button>
  @else
    <span class="text-xs text-gray-400 italic">None</span>
  @endif
</td>

    <td class="px-6 py-3 text-sm text-gray-800 dark:text-neutral-200">
<select
  wire:change="updateRepairStatus({{ $repair->repair_ID }}, $event.target.value)"
  class="mt-2 block w-full py-1.5 px-3 pe-9 border border-gray-200 rounded-lg shadow-2xs sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
  @foreach($statusLabels as $value => $label)
    <option value="{{ $value }}" @selected($repair->repair_status === $value)>{{ $label }}</option>
  @endforeach
</select>
    </td>
    <td class="px-6 py-3">
  <button
    wire:click="decline({{ $repair->repair_ID }})"
    onclick="return confirm('Are you sure you want to decline and delete this assignment?')"
    class="py-2 px-3 inline-flex items-center gap-x-2 text-xs rounded-lg border border-red-200 bg-red-100 text-red-800 hover:bg-red-200 dark:bg-red-900 dark:border-red-700 dark:text-white dark:hover:bg-red-800">
    Decline
  </button>
</td>

  </tr>
  @endforeach
</tbody>
</div>
            </table>

<!-- Image Modal -->
<div id="imageModal" class="fixed hidden inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
  <div class="relative">
    <button onclick="closeModal()" class="absolute top-0 right-0 m-4 text-white text-2xl">&times;</button>
    <img id="modalImage" class="max-w-full max-h-[90vh] rounded-lg" src="" alt="Proof Image">
  </div>
</div>



<script>
  function openTextModal(content) {
    document.getElementById('modalText').textContent = content;
    document.getElementById('textModal').classList.remove('hidden');
  }

  function closeTextModal() {
    document.getElementById('modalText').textContent = '';
    document.getElementById('textModal').classList.add('hidden');
  }
</script>

<!-- Description & Notes Modal -->
<div id="textModal" class="fixed hidden inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
  <div class="relative bg-white dark:bg-neutral-800 p-6 rounded-lg shadow-xl max-w-lg w-full">
    <button onclick="closeTextModal()" class="absolute top-0 right-0 mt-2 mr-2 text-gray-800 dark:text-white text-2xl">&times;</button>
    <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white" id="textModalTitle"></h2>
    <p id="textModalBody" class="text-gray-800 dark:text-neutral-300 whitespace-pre-line"></p>
  </div>
</div>


<script>
  function openModal(imageUrl) {
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('imageModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modalImage').src = '';
    document.getElementById('imageModal').classList.add('hidden');
  }

  function showDescription(text) {
    document.getElementById('textModalTitle').innerText = 'Description';
    document.getElementById('textModalBody').innerText = text || 'No description';
    document.getElementById('textModal').classList.remove('hidden');
  }

  function showNotes(text) {
    document.getElementById('textModalTitle').innerText = 'Notes';
    document.getElementById('textModalBody').innerText = text || 'No notes';
    document.getElementById('textModal').classList.remove('hidden');
  }

  function closeTextModal() {
    document.getElementById('textModalTitle').innerText = '';
    document.getElementById('textModalBody').innerText = '';
    document.getElementById('textModal').classList.add('hidden');
  }
</script>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
