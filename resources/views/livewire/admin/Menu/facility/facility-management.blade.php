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
                  Facility Management
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                  Manage all facility items in your system. Track status and location of 
                  <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" href="#">
                    equipment and resources.
                  </a>
                </p>
              </div>

              <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" 
                aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-facility-modal" 
                data-hs-overlay="#hs-facility-modal">
                Add Facility
              </button>

              <!-- Modal -->
              <div id="hs-facility-modal" role="dialog" tabindex="-1" aria-labelledby="hs-facility-modal-label"
                class="hs-overlay fixed inset-0 z-80 overflow-x-hidden overflow-y-auto flex items-center justify-center {{ $showModal ? 'pointer-events-auto' : 'hidden pointer-events-none' }}">
                <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
                  <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                      <h3 id="hs-facility-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Add New Facility
                      </h3>
                      <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" 
                        aria-label="Close" data-hs-overlay="#hs-facility-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M18 6 6 18"></path>
                          <path d="m6 6 12 12"></path>
                        </svg>
                      </button>
                    </div>

                    <div class="p-4 overflow-y-auto">
                      @if (session()->has('message'))
                        <div class="alert alert-success">
                          {{ session('message') }}
                        </div>
                      @endif
                      
                      <form wire:submit.prevent="store">
                        <div class="mb-4 sm:mb-8">
                          <label for="facility-name" class="block mb-2 text-sm font-medium dark:text-white">Facility Name</label>
                          <input wire:model="name" id="facility-name" type="text" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter facility name">
                        </div>

                        <div class="mb-4 sm:mb-8">
                          <label for="facility-type" class="block mb-2 text-sm font-medium dark:text-white">Type</label>
                          <select wire:model="type" id="facility-type" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option value="">Select Type</option>
                            @foreach ($types as $typeOption)
                              <option value="{{ $typeOption }}">{{ $typeOption }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="mb-4 sm:mb-8">
                          <label for="facility-building" class="block mb-2 text-sm font-medium dark:text-white">Building</label>
                          <select wire:model="building_ID" id="facility-building" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option value="">Select Building</option>
                            @foreach ($buildings as $building)
                              <option value="{{ $building->building_ID }}">{{ $building->name }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="mb-4 sm:mb-8">
                          <label for="facility-status" class="block mb-2 text-sm font-medium dark:text-white">Status</label>
                          <select wire:model="status" id="facility-status" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            @foreach ($statuses as $statusOption)
                              <option value="{{ $statusOption }}">{{ $statusOption }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="mt-6 grid">
                          <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Save Facility
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-900">
                <tr>
                <th scope="col" class="px-6 py-3 text-start">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">ID</span>
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Name</span>
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Type</span>
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Building</span>
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Status</span>
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Action</span>
                </th>
                </tr>
                </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach ($facilities as $facility)
                    <tr>
                <td class="whitespace-nowrap px-6 py-3">
                    <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $facility->facility_ID }}</span>
                </td>
                <td class="whitespace-nowrap px-6 py-3">
                    <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $facility->name }}</span>
                </td>
                <td class="whitespace-nowrap px-6 py-3">
                    <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $facility->type }}</span>
                </td>
                <td class="whitespace-nowrap px-6 py-3">
                    <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $facility->building->name ?? '-' }}</span>
                </td>
                <td class="whitespace-nowrap px-6 py-3">
                    <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium 
                    rounded-full 
                    @if($facility->status == 'Good') bg-green-100 text-green-800 dark:bg-green-500/10 
                    @elseif($facility->status == 'Fine') dark:text-yellow-500 
                    @else 
                    @endif">
                    {{ $facility->status }}
                    </span>
                </td>
                <td class="size-px whitespace-nowrap">
                                <div class="px-6 py-1.5">
                                <div class="hs-dropdown [--placement:bottom-right] relative inline-block">
                                    <button id="hs-table-dropdown-1" type="button" 
                                    class="hs-dropdown-toggle py-1.5 px-2 inline-flex justify-center items-center gap-2 rounded-lg text-gray-700 align-middle disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800" 
                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="19" cy="12" r="1"/>
                                        <circle cx="5" cy="12" r="1"/>
                                    </svg>
                                    </button>
                                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-40 z-10 bg-white shadow-2xl rounded-lg p-2 mt-2 dark:divide-neutral-700 dark:bg-neutral-800 dark:border dark:border-neutral-700" role="menu">
                                    <div class="py-2 first:pt-0 last:pb-0">
                                        <a href="{{ route('admin.menu.facility.edit-facility', ['id' => $facility->facility_ID]) }}"
                                        class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700">
                                        Edit
                                        </a>
                                    </div>
                                    <div class="py-2 first:pt-0 last:pb-0">
                                        <a wire:click.prevent="delete({{ $facility->facility_ID }})"
                                        onclick="confirm('Are you sure you want to delete this facility?') || event.stopImmediatePropagation()"
                                        class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-gray-100 dark:text-red-500 dark:hover:bg-neutral-700"
                                        href="#">
                                        Delete
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            <!-- End Table -->

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
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="m15 18-6-6 6-6"/>
                    </svg>
                    Prev
                  </button>

                  <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                    Next
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="m9 18 6-6-6-6"/>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
            <!-- End Footer -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Table Section -->
</div>


