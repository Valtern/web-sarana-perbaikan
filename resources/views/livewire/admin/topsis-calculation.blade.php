<div class="mt-6">
    {{-- Hide calculate button if stepsOnly is true --}}
    @if (!$calculated && !$stepsOnly)
        <button
            wire:click="runTOPSIS"
           class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-100 text-yellow-800 hover:bg-yellow-200 focus:outline-hidden focus:bg-yellow-200 disabled:opacity-50 disabled:pointer-events-none dark:text-yellow-500 dark:bg-yellow-800/30 dark:hover:bg-yellow-800/20 dark:focus:bg-yellow-800/20"
        >
            Calculate TOPSIS
        </button>
    @endif

    @if ($calculated)
        {{-- Final rankings only --}}
        @if ($finalOnly)
            <div class="bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 rounded-lg p-4 shadow">
                <h3 class="text-base font-semibold text-green-700 dark:text-green-400 mb-2">✅ TOPSIS Rankings (Best to Worst):</h3>
                <ul class="list-decimal pl-5 space-y-1 text-sm text-green-800 dark:text-green-300">
                    @foreach ($steps['result'] as $ranking)
                        <li>
                            {{ $ranking['alternative'] }} — Score: {{ number_format($ranking['score'], 4) }} —
                            Priority: <span class="font-semibold">{{ $ranking['priority'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Step-by-step --}}
        @if ($stepsOnly)
            <div class="space-y-6 text-sm text-gray-700 dark:text-neutral-300">
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
            </div>
        @endif
    @endif
</div>
