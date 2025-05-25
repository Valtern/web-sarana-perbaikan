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
  <div class="mt-5 lg:mt-16 grid lg:grid-cols-3 gap-8 lg:gap-12">
    <div class="lg:col-span-1">
      <h2 class="font-bold text-2xl md:text-3xl text-gray-800 dark:text-neutral-200">
        We tackle the challenges start-ups face
      </h2>
      <p class="mt-2 md:mt-4 text-gray-500 dark:text-neutral-500">
        Besides working with start-up enterprises as a partner for digitalization, we have built enterprise products for common pain points that we have encountered in various products and projects.
      </p>
    </div>
    <!-- End Col -->

    <div class="lg:col-span-2">
      <div class="grid sm:grid-cols-2 gap-8 md:gap-12">
        <!-- Icon Block -->
        <div class="flex gap-x-5">
          <svg class="shrink-0 mt-1 size-6 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="10" x="3" y="11" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><line x1="8" x2="8" y1="16" y2="16"/><line x1="16" x2="16" y1="16" y2="16"/></svg>
          <div class="grow">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
              Creative minds
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              We choose our teams carefully. Our people are the secret to great work.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-5">
          <svg class="shrink-0 mt-1 size-6 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
          <div class="grow">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
              Simple and affordable
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              From boarding passes to movie tickets, there's pretty much nothing you can't store with Preline.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-5">
          <svg class="shrink-0 mt-1 size-6 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
          <div class="grow">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
              Industry-leading documentation
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              Our documentation and extensive Client libraries contain everything a business needs to build a custom integration.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="flex gap-x-5">
          <svg class="shrink-0 mt-1 size-6 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          <div class="grow">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
              Designing for people
            </h3>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
              We actively pursue the right balance between functionality and aesthetics, creating delightful experiences.
            </p>
          </div>
        </div>
        <!-- End Icon Block -->
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
