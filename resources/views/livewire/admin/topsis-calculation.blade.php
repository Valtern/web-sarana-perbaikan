<div class="mt-10 border-t pt-6">
    <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200 mb-4">TOPSIS Calculation</h2>

    @error('topsis')
        <div class="text-red-600 mb-4">{{ $message }}</div>
    @enderror

    <button
        wire:click="runTOPSIS"
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
    >
        Calculate TOPSIS
    </button>

    @if ($calculated)
        <div class="space-y-6 mt-6 text-sm text-gray-700 dark:text-neutral-300">
            <div>
                <h3 class="font-semibold">1. Decision Matrix (X):</h3>
                <pre>{{ var_export($steps['decisionMatrix'], true) }}</pre>
            </div>

            <div>
                <h3 class="font-semibold">2. Normalization Divisors:</h3>
                <pre>{{ var_export($steps['divisors'], true) }}</pre>
            </div>

            <div>
                <h3 class="font-semibold">3. Normalized Matrix (R):</h3>
                <pre>{{ var_export($steps['normalizedMatrix'], true) }}</pre>
            </div>

            <div>
                <h3 class="font-semibold">4. Weighted Matrix (Y):</h3>
                <pre>{{ var_export($steps['weightedMatrix'], true) }}</pre>
            </div>

            <div>
                <h3 class="font-semibold">5. Ideal Solutions (A+ and A-):</h3>
                <pre>{{ var_export($steps['idealSolutions'], true) }}</pre>
            </div>

            <div>
                <h3 class="font-semibold">6. Distances (D+ and D-):</h3>
                <pre>{{ var_export($steps['distances'], true) }}</pre>
            </div>

            <div>
                <h3 class="font-semibold">7. Preference Scores (V):</h3>
                <pre>{{ var_export($steps['preference'], true) }}</pre>
            </div>

            <div class="text-green-600 dark:text-green-400 font-semibold">
                <h3>✅ Best Alternative:</h3>
                <p>{{ $steps['result']['alternative'] ?? '-' }} with score {{ $steps['result']['score'] ?? '-' }}</p>
            </div>
        </div>
    @endif
</div>
