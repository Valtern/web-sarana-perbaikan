<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your profile data')">
        <form wire:submit.prevent="updateProfileInformation" class="my-6 w-full space-y-8">

            {{-- Name --}}
            <div>
                <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />
            </div>

            {{-- Profile Picture Upload --}}
            <div class="space-y-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">
                    {{ __('Profile Photo') }}
                </label>

                <div class="flex items-center gap-4">
                    @if ($profile_picture)
                        <img src="{{ $profile_picture }}" alt="Profile Photo"
                            class="size-20 rounded-full object-cover ring-2 ring-graya-500 dark:ring-blue-400 shadow" />
                    @endif
                </div>

                <div class="space-y-2">
                    <input type="file" wire:model="photo" accept="image/*"
                        class="block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4
                               file:rounded-lg file:border-0 file:font-semibold
                               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-neutral-700 dark:file:text-white" />

                    @error('photo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    @if ($profile_picture)
                        <flux:button wire:click="deleteProfilePhoto" type="button" variant="danger">
                            {{ __('Delete Photo') }}
                        </flux:button>
                    @endif
                </div>
            </div>

            {{-- Email --}}
            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Your email address is unverified.') }}
                        <flux:link class="cursor-pointer text-blue-600 hover:underline dark:text-blue-400"
                                   wire:click.prevent="resendVerificationNotification">
                            {{ __('Click here to re-send the verification email.') }}
                        </flux:link>

                        @if (session('status') === 'verification-link-sent')
                            <div class="mt-2 font-medium text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Save Button --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <flux:button variant="primary" type="submit" class="w-full sm:w-auto">
                    {{ __('Save') }}
                </flux:button>

                <x-action-message class="text-green-600 dark:text-green-400" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        {{-- Danger Zone: Delete User --}}
        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
