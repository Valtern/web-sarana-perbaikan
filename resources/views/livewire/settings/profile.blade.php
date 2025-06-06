{{-- {{dd($profile_picture)}} --}}
<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your profile data')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />
            <div class="space-y-4">
                <!-- Foto Profil -->
                <div class="flex items-center gap-4">
                    @if ($profile_picture)
                        <img src="{{ $profile_picture }}" alt="Profile Photo"
                            class="size-20 rounded-full object-cover ring-2 ring-black-400 dark:ring-black-600">
                    @endif
                    
                </div>
                <div class="space-y-2">
                        <input type="file" wire:model="photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                       file:rounded-full file:border-0 file:text-sm file:font-semibold
                       file:bg-blue-50 file:text-bl-700 hover:file:bg-blue-100" />

                        @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                        @if ($profile_picture)
                            <flux:button wire:click="deleteProfilePhoto" type="button" variant="danger">
                                {{ __('Delete Photo') }}
                            </flux:button>
                        @endif
                    </div>
            </div>

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>