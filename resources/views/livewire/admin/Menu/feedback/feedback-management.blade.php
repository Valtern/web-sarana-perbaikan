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
                  Feedback Management
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                  Manage all feedback in your system Track respond of 
                  <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" href="#">
                    Users.
                  </a>
                </p>
              </div>
</div>

<!-- Table -->
<!-- Table -->
<div class="overflow-x-auto shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
  <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 text-sm">
    <!-- Table Head -->
    <thead class="bg-gray-50 dark:bg-neutral-900">
      <tr class="text-left text-gray-800 dark:text-neutral-200 uppercase text-xs font-semibold">
        <th class="px-6 py-3">ID</th>
        <th class="px-6 py-3">Repair ID</th>
        <th class="px-6 py-3">Submitted By</th>
        <th class="px-6 py-3">Feedback</th>
        <th class="px-6 py-3">Rate</th>
        <th class="px-6 py-3">Action</th>
      </tr>
    </thead>

    <!-- Table Body -->
    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
      @foreach ($feedbacks as $feedback)
      <tr class="text-gray-700 dark:text-neutral-400">
        <!-- Feedback ID -->
        <td class="px-6 py-3 whitespace-nowrap">{{ $feedback->feedback_ID }}</td>

        <!-- Repair ID -->
        <td class="px-6 py-3 whitespace-nowrap">{{ $feedback->repairs_ID }}</td>

        <!-- Submitted By -->
        <td class="px-6 py-3 whitespace-nowrap">{{ $feedback->submitted_by }}</td>

        <!-- Feedback Content -->
        <td class="px-6 py-3 whitespace-nowrap">
          {{ $feedback->feedback_content ?? '-' }}
        </td>

        <!-- Rate -->
        <td class="px-6 py-3 whitespace-nowrap">
          <span class="inline-flex items-center gap-x-1 px-2 py-1 rounded-full text-xs font-medium 
            {{ $feedback->rate >= 4 ? 'bg-green-100 text-green-800 dark:bg-green-500/10 dark:text-green-500' : 
               ($feedback->rate >= 2 ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-500' : 
               'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500') }}">
            {{ $feedback->rate }} ★
          </span>
        </td>

        <!-- Action Buttons -->
        <td class="px-6 py-3 whitespace-nowrap">
          <button
            wire:click="delete({{ $feedback->feedback_ID }})"
            onclick="confirm('Are you sure you want to delete this feedback?') || event.stopImmediatePropagation()"
            type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-hidden focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:bg-red-800/30 dark:hover:bg-red-800/20 dark:focus:bg-red-800/20">
            Delete
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- End Table -->

