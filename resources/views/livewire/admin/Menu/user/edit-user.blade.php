<div>
    <div>
    <div class="max-w-xl mx-auto p-6 bg-white dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">

        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Edit User</h2>

        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="update" class="space-y-6">

            <div>
                <label for="name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Name</label>
                <input type="text" id="name" wire:model.defer="name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300" />
                @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Email</label>
                <input type="email" id="email" wire:model.defer="email"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300" />
                @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="role" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Role</label>
                <select id="role" wire:model.defer="role"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300">
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $r)
                        <option value="{{ $r }}">{{ ucfirst($r) }}</option>
                    @endforeach
                </select>
                @error('role') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Password (leave blank to keep current)</label>
                <input type="password" id="password" wire:model.defer="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300" />
                @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit"
                    class="w-full py-3 px-4 font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-200">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>

</div>
