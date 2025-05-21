<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
<script src="./assets/vendor/preline/dist/preline.js"></script>
</x-layouts.app.sidebar>
