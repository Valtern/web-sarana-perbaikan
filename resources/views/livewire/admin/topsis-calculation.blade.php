<div class="mt-10 border-t pt-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200 mb-6">
        TOPSIS Calculation
    </h2>

    @error('topsis')
        <div class="text-red-600 mb-4">{{ $message }}</div>
    @enderror

    <button
        wire:click="runTOPSIS"
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm"
    >
        Calculate TOPSIS
    </button>

    @if ($calculated)
        <div class="space-y-6 mt-6 text-sm text-gray-700 dark:text-neutral-300">

            @foreach([
                '1. Decision Matrix (X)' => 'decisionMatrix',
                '2. Normalization Divisors' => 'divisors',
                '3. Normalized Matrix (R)' => 'normalizedMatrix',
                '4. Weighted Matrix (Y)' => 'weightedMatrix',
                '5. Ideal Solutions (A+ and A-)' => 'idealSolutions',
                '6. Distances (D+ and D-)' => 'distances',
                '7. Preference Scores (V)' => 'preference'
            ] as $title => $key)
                <div class="bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg p-4 shadow">
                    <h3 class="text-base font-semibold text-gray-800 dark:text-white mb-2">{{ $title }}</h3>
                    <pre class="whitespace-pre-wrap break-all text-sm">{{ var_export($steps[$key], true) }}</pre>
                </div>
            @endforeach

            <div class="bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 rounded-lg p-4 shadow">
                <h3 class="text-base font-semibold text-green-700 dark:text-green-400 mb-1">✅ Best Alternative:</h3>
                <p class="text-sm text-green-800 dark:text-green-300">
                    {{ $steps['result']['alternative'] ?? '-' }} with score {{ $steps['result']['score'] ?? '-' }}
                </p>
            </div>
        </div>
    @endif
</div>
