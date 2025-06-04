<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen">

    {{-- Header/Nav --}}
    <header class="w-full max-w-6xl mx-auto px-6 py-6 flex justify-end gap-4">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-5 py-1.5 border border-[#19140035] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-5 py-1.5 border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-5 py-1.5 border border-[#19140035] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm">
                        Register
                    </a>
                @endif
            @endauth
        @endif
    </header>

    {{-- Hero Section --}}
    <section class="relative overflow-hidden">
  <!-- Hero -->
  <div class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/squared-bg-element.svg')] dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/squared-bg-element.svg')] before:bg-no-repeat before:bg-top before:size-full before:-z-1 before:transform before:-translate-x-1/2">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">

      <!-- Announcement Banner -->
      <div class="flex justify-center">
        <a class="inline-flex items-center gap-x-2 bg-white border border-gray-200 text-xs text-gray-600 p-2 px-3 rounded-full transition hover:border-gray-300 focus:outline-hidden focus:border-gray-300 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:border-neutral-600 dark:focus:border-neutral-600" href="#">
          Explore the Capital Product
          <span class="flex items-center gap-x-1">
            <span class="border-s border-gray-200 text-blue-600 ps-2 dark:text-blue-500 dark:border-neutral-700">Explore</span>
            <svg class="shrink-0 size-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"><path d="m9 18 6-6-6-6"/></svg>
          </span>
        </a>
      </div>
      <!-- End Announcement Banner -->

      <!-- Title -->
      <div class="mt-7 max-w-3xl text-center mx-auto">
        <h1 class="block font-bold text-gray-800 text-5xl md:text-6xl lg:text-7xl dark:text-neutral-200">
          Facility Repair System
        </h1>
      </div>
      <!-- End Title -->

      <!-- Subtitle -->
      <div class="mt-6 max-w-3xl text-center mx-auto">
        <p class="text-xl text-gray-600 dark:text-neutral-400">
          Preline is a large open-source project, crafted with Tailwind CSS framework by Hmlstream.
        </p>
      </div>

      <!-- Buttons -->
      <div class="mt-10 gap-4 flex justify-center">
        <a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-blue-600 to-violet-600 hover:from-violet-600 hover:to-blue-600 focus:outline-hidden focus:from-violet-600 focus:to-blue-600 border border-transparent text-white text-sm font-medium rounded-full py-4 px-6" href="#">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
          </svg>
          Continue with GitHub
        </a>
      </div>
      <!-- End Buttons -->

    </div>
  </div>
  <!-- Features -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <div class="aspect-w-16 aspect-h-7">

  </div>

  <!-- Grid -->
 <!-- Icon Blocks -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <div class="max-w-4xl mx-auto">
    <!-- Grid -->
    <div class="grid md:grid-cols-2 gap-6 lg:gap-12">
      <div class="space-y-6 lg:space-y-10">
        <!-- Icon Block -->
        <div class="flex gap-x-5 sm:gap-x-8">
          <svg class="shrink-0 mt-2 size-8 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="10" x="3" y="11" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><line x1="8" x2="8" y1="16" y2="16"/><line x1="16" x2="16" y1="16" y2="16"/></svg>
          <div class="grow">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
              Creative minds
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              We choose our teams carefully. Our people are the secret to great work.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-5 sm:gap-x-8">
          <svg class="shrink-0 mt-2 size-8 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
          <div class="grow">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
              Effortless updates
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              Benefit from automatic updates to all boards any time you need to make a change to your website.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-5 sm:gap-x-8">
          <svg class="shrink-0 mt-2 size-8 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
          <div class="grow">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
              Strong empathy
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              We've user tested our own process by shipping over 1k products for clients.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->
      </div>
      <!-- End Col -->

      <div class="space-y-6 lg:space-y-10">
        <!-- Icon Block -->
        <div class="flex gap-x-5 sm:gap-x-8">
          <svg class="shrink-0 mt-2 size-8 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
          <div class="grow">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
              Conquer the best
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              We stay lean and help your product do one thing well.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-5 sm:gap-x-8">
          <svg class="shrink-0 mt-2 size-8 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          <div class="grow">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
              Designing for people
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              We actively pursue the right balance between functionality and aesthetics, creating delightful experiences.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-5 sm:gap-x-8">
          <svg class="shrink-0 mt-2 size-8 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
          <div class="grow">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-neutral-200">
              Simple and affordable
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              From boarding passes to movie tickets, there's pretty much nothing you can't store with Preline.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->
      </div>
      <!-- End Col -->
    </div>
    <!-- End Grid -->
  </div>
</div>
<!-- End Icon Blocks -->
  <!-- End Grid -->
</div>
<!-- End Features -->
<!-- Features -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid -->
  <div class="md:grid md:grid-cols-2 md:items-center md:gap-12 xl:gap-32">
    <div>
      <img class="rounded-xl" src="https://images.unsplash.com/photo-1648737963503-1a26da876aca?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=900&h=900&q=80" alt="Features Image">
    </div>
    <!-- End Col -->

    <div class="mt-5 sm:mt-10 lg:mt-0">
      <div class="space-y-6 sm:space-y-8">
        <!-- Title -->
        <div class="space-y-2 md:space-y-4">
          <h2 class="font-bold text-3xl lg:text-4xl text-gray-800 dark:text-neutral-200">
            We tackle the challenges start-ups face
          </h2>
          <p class="text-gray-500 dark:text-neutral-500">
            Besides working with start-up enterprises as a partner for digitalization, we have built enterprise products for common pain points that we have encountered in various products and projects.
          </p>
        </div>
        <!-- End Title -->

        <!-- List -->
        <ul class="space-y-2 sm:space-y-4">
          <li class="flex gap-x-3">
            <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <div class="grow">
              <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                <span class="font-bold">Easy & fast</span> designing
              </span>
            </div>
          </li>

          <li class="flex gap-x-3">
            <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <div class="grow">
              <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                Powerful <span class="font-bold">features</span>
              </span>
            </div>
          </li>

          <li class="flex gap-x-3">
            <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <div class="grow">
              <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                User Experience Design
              </span>
            </div>
          </li>
        </ul>
        <!-- End List -->
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Features -->


</section>


</body>
</html>
