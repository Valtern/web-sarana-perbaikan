@php
$statusLabels = [
    'Not_started' => 'Not Started',
    'In_progress' => 'In Progress',
    'Completed' => 'Completed',
];
@endphp

<div wire:poll.5s="checkNewRepair">
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
                  Repairs Assignment
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                  List of assigned repairs by the admin.
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
    <td class="px-6 py-4 whitespace-nowrap text-sm">
                  <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-100 text-teal-800 hover:bg-teal-200 focus:outline-hidden focus:bg-teal-200 disabled:opacity-50 disabled:pointer-events-none dark:text-teal-500 dark:bg-teal-800/30 dark:hover:bg-teal-800/20 dark:focus:bg-teal-800/20" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-description-modal" data-hs-overlay="#hs-description-modal">
                    View
                  </button>
                </td>

     <td class="px-6 py-4 whitespace-nowrap text-sm">               
                    <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-hidden focus:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-vertically-centered-modal" data-hs-overlay="#hs-vertically-centered-modal">
                    View
                  </button>                
                </td>

    <td class="px-6 py-3 text-sm text-gray-800 dark:text-neutral-200">
      {{ $repair->report->priority_Assignment ?? 'N/A' }}
    </td>

     <td class="px-6 py-4 whitespace-nowrap text-sm">               
                    <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-100 text-yellow-800 hover:bg-yellow-200 focus:outline-hidden focus:bg-yellow-200 disabled:opacity-50 disabled:pointer-events-none dark:text-yellow-500 dark:bg-yellow-800/30 dark:hover:bg-yellow-800/20 dark:focus:bg-yellow-800/20" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-notes-modal" data-hs-overlay="#hs-notes-modal">
                    View
                  </button>   
                               
                </td>

          <td class="px-6 py-3 text-sm text-gray-800 dark:text-neutral-200">
          <div class="hs-dropdown relative inline-flex">
            <button id="hs-dropdown-unstyled" type="button"
              class="hs-dropdown-toggle inline-flex justify-center items-center gap-x-2 text-sm font-medium text-gray-700 dark:text-neutral-300 border border-gray-300 dark:border-neutral-600 rounded-lg px-4 py-2 bg-white dark:bg-neutral-900 hover:bg-gray-100 dark:hover:bg-neutral-800"
              aria-expanded="false" aria-label="Menu">
              Actions
            </button>

            <div
              class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10 mt-2 w-56 bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg shadow-lg p-2 space-y-1"
              role="menu" aria-labelledby="hs-dropdown-unstyled">
              
              @foreach($statusLabels as $value => $label)
                <button
                  wire:click="updateRepairStatus({{ $repair->repair_ID }}, '{{ $value }}')"
                  class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-neutral-200 hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-md"
                  role="menuitem">
                  {{ $label }}
                </button>
              @endforeach

            </div>
          </div>
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
<div id="hs-vertically-centered-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-vertically-centered-modal-label">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
    <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="hs-vertically-centered-modal-label" class="font-bold text-gray-800 dark:text-white">
          Detail Laporan
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-vertically-centered-modal">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
      <div class="p-4 overflow-y-auto space-y-4 text-gray-800 dark:text-neutral-400">
        @if ($repair->report->picture_proof)
          <div>
            <strong>Picture Proof:</strong><br>
            <img src="{{ Storage::url($repair->report->picture_proof) }}" alt="Bukti kerusakan" class="max-w-full rounded-lg border border-gray-300 dark:border-neutral-600 shadow" />
          </div>
        @else
          <p><em>Tidak ada foto bukti.</em></p>
        @endif
      </div>
    </div>
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

<!-- Description Modal -->
<div id="hs-description-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-description-modal-label">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
    <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="hs-description-modal-label" class="font-bold text-gray-800 dark:text-white">
          Report Description
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-description-modal">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
      <div class="p-4 overflow-y-auto text-gray-800 dark:text-neutral-400 space-y-4">
        <p>{{ $repair->report->description ?? 'Tidak ada deskripsi tersedia.' }}</p>
      </div>
    </div>
  </div>
</div>

<!-- Notes Modal -->
<div id="hs-notes-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-notes-modal-label">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
    <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="hs-notes-modal-label" class="font-bold text-gray-800 dark:text-white">
          Report notes
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-notes-modal">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
      <div class="p-4 overflow-y-auto text-gray-800 dark:text-neutral-400 space-y-4">
        <p>{{ $repair->notes ?? 'Tidak ada deskripsi tersedia.' }}</p>
      </div>
    </div>
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
