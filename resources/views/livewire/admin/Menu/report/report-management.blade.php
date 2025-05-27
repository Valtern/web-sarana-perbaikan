<div wire:poll.5s>
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Card -->
    <div class="flex flex-col">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
            
            <!-- Header -->
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
              <!-- Title and Description -->
              <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">Reports</h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                  Keys you have generated to connect with third-party clients or access the 
                  <a href="#" class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium dark:text-blue-500">
                    Preline API.
                  </a>
                </p>
              </div>

              <!-- Search and Datepicker -->
              <div class="flex flex-col gap-3 md:flex-row md:items-center">
                <!-- Search Input -->
                <div class="relative">
                  <input type="text" placeholder="Search reports..." class="py-2 pl-10 pr-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200" />
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400 dark:text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M5 11a6 6 0 1112 0 6 6 0 01-12 0z" />
                    </svg>
                  </div>
                </div>

                <!-- Datepicker Input -->
                <div class="relative">
                  <input id="datepicker" type="text" placeholder="Select date" class="py-2 pl-10 pr-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200" />
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400 dark:text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-5 4h6a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-900">
                  <tr>
                    <th class="ps-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">ID</th>
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
                  @foreach($reports as $report)
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
                        <span class="text-xs font-semibold px-2 py-1 rounded-lg {{ $statusColors[$report->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200' }}">
                          {{ Str::headline(str_replace('_', ' ', $report->status)) }}
                        </span>
                        <select wire:change="updateStatus({{ $report->report_ID }}, $event.target.value)" class="py-3 px-4 pe-1  rounded-full text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                          <option value="" disabled selected hidden>Change</option>
                          @foreach(['Pending', 'In_progress', 'Solved', 'Declined'] as $status)
                            @if ($report->status !== $status)
                              <option value="{{ $status }}">{{ Str::headline(str_replace('_', ' ', $status)) }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </td>
                    <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ \Carbon\Carbon::parse($report->created_at)->format('d M, H:i') }}</td>
                    <td class="px-6 py-3">
                      <button type="button" onclick="openDescriptionModal(@js($report->description))" class="inline-flex items-center gap-x-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 px-3 py-1.5 dark:bg-gray-700 dark:text-white hover:underline">
                        View
                      </button>
                    </td>
                    <td class="px-6 py-3">
                      @if($report->picture_proof)
                        <button type="button" onclick="openProofModal(@js(url($report->picture_proof)))" class="inline-flex items-center gap-x-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 px-3 py-1.5 dark:bg-blue-500/10 dark:text-blue-500 hover:underline">
                          View Proof
                        </button>
                      @else
                        <span class="text-xs text-gray-400 italic">No image</span>
                      @endif
                    </td>
                    <td class="px-6 py-3 text-sm">
                      <button wire:click="deleteReport({{ $report->report_ID }})" onclick="return confirm('Are you sure you want to delete this report?')" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-red-100 text-red-800 hover:bg-red-200 dark:text-red-500 dark:bg-red-800/30 dark:hover:bg-red-800/20">
                        Delete
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <!-- Modals -->
            
            <div id="proofModal"
                class="hs-overlay hidden fixed inset-0 z-50 overflow-y-auto bg-black/75 flex items-center justify-center"
                data-hs-overlay-keyboard="true"
                role="dialog"
                aria-modal="true">
              <div class="relative">
                <button type="button"
                        class="absolute top-0 right-0 m-4 text-white text-2xl"
                        aria-label="Close"
                        data-hs-overlay="#proofModal"
                        onclick="closeProofModal()">
                  &times;
                </button>
                <img id="proofImage" class="max-w-full max-h-[90vh] rounded-lg" src="" alt="Proof Image">
              </div>
            </div>


            <!-- Description Modal -->
            <div id="descriptionModal"
                class="hs-overlay hidden fixed inset-0 z-50 overflow-y-auto bg-black/50 flex items-center justify-center"
                data-hs-overlay-keyboard="true"
                role="dialog"
                aria-modal="true">
              <div class="relative bg-white dark:bg-neutral-800 rounded-xl p-6 max-w-md w-full mx-3 shadow-xl">
                <button type="button"
                        class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-xl"
                        aria-label="Close"
                        data-hs-overlay="#descriptionModal"
                        onclick="closeDescriptionModal()">
                  &times;
                </button>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Report Description</h3>
                <p id="descriptionText" class="text-gray-700 dark:text-gray-300 whitespace-pre-line"></p>
              </div>
            </div>


            <!-- Scripts -->
            <script>
              function openProofModal(imageUrl) {
                document.getElementById('proofImage').src = imageUrl;
                window.HSOverlay.open(document.getElementById('proofModal'));
              }

              function closeProofModal() {
                document.getElementById('proofImage').src = '';
                window.HSOverlay.close(document.getElementById('proofModal'));
              }

              function openDescriptionModal(description) {
                document.getElementById('descriptionText').innerText = description || 'No description provided.';
                window.HSOverlay.open(document.getElementById('descriptionModal'));
              }

              function closeDescriptionModal() {
                document.getElementById('descriptionText').innerText = '';
                window.HSOverlay.close(document.getElementById('descriptionModal'));
              }
            </script>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
