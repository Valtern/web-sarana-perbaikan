<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>

<script src="./assets/vendor/preline/dist/preline.js"></script>
<script src="./node_modules/lodash/lodash.min.js"></script>
<script src="./node_modules/vanilla-calendar-pro/index.js"></script>
</x-layouts.app.sidebar>
