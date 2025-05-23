<div wire:poll.5s>
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
        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Facility Name</span>
      </th>
      <th class="px-6 py-3 text-start">
        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Description</span>
      </th>
      <th class="px-6 py-3 text-start">
        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Created</span>
      </th>
      <th class="px-6 py-3 text-start">
        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Proof</span>
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
      <td class="px-6 py-3 text-sm text-gray-600 dark:text-neutral-400">{{ $report->created_at->format('d M, H:i') }}</td>
<td class="px-6 py-3">
  @if($report->picture_proof)
    <button
      type="button"
      onclick="openModal(@js(url($report->picture_proof)))"
      class="py-2 px-3 inline-flex items-center gap-x-2 text-xs rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
      View Proof
    </button>
  @else
    <span class="text-xs text-gray-400 italic">No image</span>
  @endif
</td>

    </tr>
    @endforeach
  </tbody>
</table>
  </table>

  <div id="imageModal" class="fixed hidden inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
  <div class="relative">
    <button onclick="closeModal()" class="absolute top-0 right-0 m-4 text-white text-2xl">&times;</button>
    <img id="modalImage" class="max-w-full max-h-[90vh] rounded-lg" src="" alt="Proof Image">
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
</script>
</div>
