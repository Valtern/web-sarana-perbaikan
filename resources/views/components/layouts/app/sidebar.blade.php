<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">

    @php
        $role = auth()->user()->role;
        $dashboardRoute = match($role) {
            'admin' => 'admin.dashboard',
            'lecturer' => 'lecturer.dashboard',
            'student' => 'student.dashboard',
            'staff' => 'staff.dashboard',
            'technician' => 'technician.dashboard',
            default => 'home',
        };
    @endphp

    <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route($dashboardRoute) }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
    {{-- Common Items --}}
    <flux:navlist.group :heading="__('Platform')" class="grid">
        <flux:navlist.item
            icon="home"
            :href="route($dashboardRoute)"
            :current="request()->routeIs($dashboardRoute)"
            wire:navigate
        >
            {{ __('Dashboard') }}
        </flux:navlist.item>
    </flux:navlist.group>

    {{-- Role-specific Navigation --}}

    @switch($role)
    @case('lecturer')
            <flux:navlist.group :heading="__('Lecturer Menu')" class="grid">
                <flux:navlist.item
                    icon="users"
                    :href="route('lecturer.report')"
                    :current="request()->routeIs('lecturer.report')"
                    wire:navigate
                >
                    {{ __('Report') }}
                </flux:navlist.item>

                <flux:navlist.item
                icon="building-office"
                :href="route('lecturer.building.list')"
                :current="request()->routeIs('lecturer.building.list')"
                wire:navigate
            >
                {{ __('Building') }}
                </flux:navlist.item>

                <flux:navlist.item
                    icon="cube"
                    :href="route('lecturer.facility.list')"
                    :current="request()->routeIs('lecturer.facility.list')"
                    wire:navigate
                >
                    {{ __('Facility') }}
                </flux:navlist.item>

                <flux:navlist.item
                    icon="chat-bubble-left"
                    :href="route('lecturer.feedback.list')"
                    :current="request()->routeIs('lecturer.feedback.list')"
                    wire:navigate
                >
                    {{ __('Feedback') }}
                </flux:navlist.item>
            </flux:navlist.group>
            @break

        @case('admin')
    <flux:navlist.group :heading="__('Admin Menu')" class="grid">
        <flux:navlist.item
            icon="document"
            :href="route('report.management')"
            :current="request()->routeIs('report.management')"
            wire:navigate
        >
            {{ __('Reports') }}
        </flux:navlist.item>

        <flux:navlist.item
            icon="users"
            :href="route('user.management')"
            :current="request()->routeIs('user.management')"
            wire:navigate
        >
            {{ __('Users') }}
        </flux:navlist.item>

        <flux:navlist.item
            icon="chat-bubble-left"
            :href="route('feedback.management')"
            :current="request()->routeIs('feedback.management')"
            wire:navigate
        >
            {{ __('Feedbacks') }}
        </flux:navlist.item>

        <flux:navlist.item
            icon="building-office"
            :href="route('building.management')"
            :current="request()->routeIs('building.management')"
            wire:navigate
        >
            {{ __('Buildings') }}
        </flux:navlist.item>

        <flux:navlist.item
            icon="cube"
            :href="route('facility.management')"
            :current="request()->routeIs('facility.management')"
            wire:navigate
        >
            {{ __('Facilities') }}
        </flux:navlist.item>
    </flux:navlist.group>

        {{-- New Group for Assignments --}}
        <flux:navlist.group :heading="__('Tools')" class="grid">
            <flux:navlist.item
                icon="flag"
                :href="route('assign.priority')"
                :current="request()->routeIs('assign.priority')"
                wire:navigate
            >
                {{ __('Assign Priority') }}
            </flux:navlist.item>

            <flux:navlist.item
                icon="wrench"
                :href="route('assign.technician')"
                :current="request()->routeIs('assign.technician')"
                wire:navigate
            >
                {{ __('Assign Technician') }}
            </flux:navlist.item>
        </flux:navlist.group>
    @break


        @case('student')
            <flux:navlist.group :heading="__('Student Menu')" class="grid">
                <flux:navlist.item
                    icon="document"
                    :href="route('student.report')"
                    :current="request()->routeIs('student.report')"
                    wire:navigate
                >
                    {{ __('Report') }}
                </flux:navlist.item>
                <flux:navlist.item
                icon="building-office"
                :href="route('student.building.list')"
                :current="request()->routeIs('student.building.list')"
                wire:navigate
            >
                {{ __('Building') }}
                </flux:navlist.item>

                <flux:navlist.item
                    icon="cube"
                    :href="route('student.facility.list')"
                    :current="request()->routeIs('student.facility.list')"
                    wire:navigate
                >
                    {{ __('Facility') }}
                </flux:navlist.item>

                <flux:navlist.item
                    icon="chat-bubble-left"
                    :href="route('student.feedback.list')"
                    :current="request()->routeIs('student.feedback.list')"
                    wire:navigate
                >
                    {{ __('Feedback') }}
                </flux:navlist.item>
                </flux:navlist.group>
            @break

        @case('staff')
            <flux:navlist.group :heading="__('Staff Menu')" class="grid">
                <flux:navlist.item
                    icon="document"
                    :href="route('staff.report')"
                    :current="request()->routeIs('staff.report')"
                    wire:navigate
                >
                    {{ __('Report') }}
                </flux:navlist.item>
                <flux:navlist.item
                icon="building-office"
                :href="route('building.list')"
                :current="request()->routeIs('building.list')"
                wire:navigate
            >
                {{ __('Building') }}
                </flux:navlist.item>

                <flux:navlist.item
                    icon="cube"
                    :href="route('facility.list')"
                    :current="request()->routeIs('facility.list')"
                    wire:navigate
                >
                    {{ __('Facility') }}
                </flux:navlist.item>

                <flux:navlist.item
                    icon="chat-bubble-left"
                    :href="route('feedback.list')"
                    :current="request()->routeIs('feedback.list')"
                    wire:navigate
                >
                    {{ __('Feedback') }}
                </flux:navlist.item>
            </flux:navlist.group>
            @break

            @case('technician')
            <flux:navlist.group :heading="__('Technician Tools')" class="grid">
                <flux:navlist.item
                    icon="users"
                    :href="route('manage.report.status')"
                    :current="request()->routeIs('manage.report.status')"
                    wire:navigate
                >
                    {{ __('Manage Assignment') }}
                </flux:navlist.item>

                <flux:navlist.item
                icon="building-office"
                :href="route('technician.building.list')"
                :current="request()->routeIs('technician.building.list')"
                wire:navigate
            >
                {{ __('Building') }}
                </flux:navlist.item>

                <flux:navlist.item
                    icon="cube"
                    :href="route('technician.facility.list')"
                    :current="request()->routeIs('technician.facility.list')"
                    wire:navigate
                >
                    {{ __('Facility') }}
                </flux:navlist.item>
            </flux:navlist.group>
            @break

        @default
            {{-- Optional: default navigation for unknown roles --}}
    @endswitch
</flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
            </flux:navlist.item>

            <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
            </flux:navlist.item>
        </flux:navlist>

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down"
            />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}
    <!-- ========== FOOTER ========== -->
<flux:footer class="w-full px-4 sm:px-6 lg:px-8 bg-white dark:bg-neutral-900">
  <div class="py-6 border-t border-gray-200 dark:border-neutral-700">
    <div class="flex flex-wrap justify-between items-center gap-2">
      <div>
        <p class="text-xs text-gray-600 dark:text-neutral-400">
          © 2025 Campus Facility Reporting System.
        </p>
      </div>

      <ul class="flex flex-wrap items-center">
        <li class="inline-block relative pe-4 text-xs last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-1.5 before:-translate-y-1/2 before:size-[3px] before:rounded-full before:bg-gray-400 dark:text-neutral-500 dark:before:bg-neutral-600">
          <a class="text-xs text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-hidden focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="#">
            X (Twitter)
          </a>
        </li>
        <li class="inline-block relative pe-4 text-xs last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-1.5 before:-translate-y-1/2 before:size-[3px] before:rounded-full before:bg-gray-400 dark:text-neutral-500 dark:before:bg-neutral-600">
          <a class="text-xs text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-hidden focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="#">
            Dribbble
          </a>
        </li>
        <li class="inline-block pe-4 text-xs">
          <a class="text-xs text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-hidden focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="#">
            Github
          </a>
        </li>
        <li class="inline-block">
          <!-- Dark Mode -->
          <button type="button" class="hs-dark-mode hs-dark-mode-active:hidden relative flex justify-center items-center size-7 border border-gray-200 text-gray-500 rounded-full hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-theme-click-value="dark">
            <span class="sr-only">Dark</span>
            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
          </button>
          <button type="button" class="hs-dark-mode hs-dark-mode-active:flex hidden relative justify-center items-center size-7 border border-gray-200 text-gray-500 rounded-full hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-theme-click-value="light">
            <span class="sr-only">Light</span>
            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
          </button>
          <!-- End Dark Mode -->
        </li>
      </ul>
    </div>
  </div>
</flux:footer>

<!-- ========== END FOOTER ========== -->
    @fluxScripts

    <x-toaster-hub /> <!-- 👈 -->


</body>
</html>
