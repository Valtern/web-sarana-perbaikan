<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-gray-100 dark:bg-zinc-800">


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

    <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
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
                    icon="newspaper"
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
                    icon="newspaper"
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
                    icon="newspaper"
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

        <flux:spacer />
        <flux:menu.radio.group>
                    <flux:menu.item :href="route('faq.appearancefaq')" icon="information-circle" wire:navigate>
                        {{ __('FAQ Sections') }}
                    </flux:menu.item>
        </flux:menu.radio.group>

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
<flux:footer class="mt-auto w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <!-- Grid -->
  <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-5">
    <div>
      <a class="flex-none text-xl font-semibold text-black focus:outline-hidden dark:text-white" href="#" aria-label="Brand">IRIS</a>
    </div>
    <!-- End Col -->

    <ul class="text-center">
      <li class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:content-['/'] before:text-gray-300 dark:before:text-neutral-600">
        <a class="inline-flex gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200 dark:focus:text-neutral-200" href="#">
          About
        </a>
      </li>
      <li class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:content-['/'] before:text-gray-300 dark:before:text-neutral-600">
        <a class="inline-flex gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200 dark:focus:text-neutral-200" href="#">
          Services
        </a>
      </li>
      <li class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:content-['/'] before:text-gray-300 dark:before:text-neutral-600">
        <a class="inline-flex gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200 dark:focus:text-neutral-200" href="#">
          Blog
        </a>
      </li>
    </ul>
    <!-- End Col -->

    <!-- Social Brands -->
    <div class="md:text-end space-x-2">
      <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#">
        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
        </svg>
      </a>
      <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#">
        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
        </svg>
      </a>
      <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#">
        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
        </svg>
      </a>
      <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#">
        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M3.362 10.11c0 .926-.756 1.681-1.681 1.681S0 11.036 0 10.111C0 9.186.756 8.43 1.68 8.43h1.682v1.68zm.846 0c0-.924.756-1.68 1.681-1.68s1.681.756 1.681 1.68v4.21c0 .924-.756 1.68-1.68 1.68a1.685 1.685 0 0 1-1.682-1.68v-4.21zM5.89 3.362c-.926 0-1.682-.756-1.682-1.681S4.964 0 5.89 0s1.68.756 1.68 1.68v1.682H5.89zm0 .846c.924 0 1.68.756 1.68 1.681S6.814 7.57 5.89 7.57H1.68C.757 7.57 0 6.814 0 5.89c0-.926.756-1.682 1.68-1.682h4.21zm6.749 1.682c0-.926.755-1.682 1.68-1.682.925 0 1.681.756 1.681 1.681s-.756 1.681-1.68 1.681h-1.681V5.89zm-.848 0c0 .924-.755 1.68-1.68 1.68A1.685 1.685 0 0 1 8.43 5.89V1.68C8.43.757 9.186 0 10.11 0c.926 0 1.681.756 1.681 1.68v4.21zm-1.681 6.748c.926 0 1.682.756 1.682 1.681S11.036 16 10.11 16s-1.681-.756-1.681-1.68v-1.682h1.68zm0-.847c-.924 0-1.68-.755-1.68-1.68 0-.925.756-1.681 1.68-1.681h4.21c.924 0 1.68.756 1.68 1.68 0 .926-.756 1.681-1.68 1.681h-4.21z"/>
        </svg>
      </a>
    </div>
    <!-- End Social Brands -->
    
  </div>
  <!-- End Grid -->
  
</flux:footer>

<!-- ========== END FOOTER ========== -->
    @fluxScripts

    <x-toaster-hub /> <!-- 👈 -->


</body>
</html>
