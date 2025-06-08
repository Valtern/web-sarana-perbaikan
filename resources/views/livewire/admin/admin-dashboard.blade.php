<div><!-- Card Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Hero Welcome Section -->
  <div class="p-6 shadow bg-blue-600 bg-[url('https://preline.co/assets/svg/examples/abstract-1.svg')] bg-no-repeat bg-cover  rounded-3xl  bg-left-top text-left mb-10">


    <div class="flex flex-col lg:flex-row items-center gap-6 lg:gap-10 justify-between">
      <div class="max-w-2xl">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white dark:text-white mb-6">
        Welcome <span class="text-yellow-200">{{ $user->name }}</span>
      </h1>
        <p class="text-base text-white dark:text-gray-300">
        Welcome, <span class="font-semibold text-yellow-200">{{ $user->name }}</span>! You are now logged in as an 
        <span class="font-medium text-yellow-200 capitalize">{{ $user->role }}</span>. As an administrator, you have full access to manage users, monitor reports, and oversee system operations. 
        All important notifications and updates will be sent to your registered email address at 
        <a href="mailto:{{ $user->email }}" class="text-yellow-200 underline hover:no-underline">{{ $user->email }}</a>. 
      </p>
      </div>
      <img src="{{ $user->profile_picture_url }}" alt="Profile Picture" class="w-48 h-60 rounded-lg object-cover shadow-lg">
    </div>
  </div>

  <!-- Statistic Cards Grid -->
 <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
    
    <!-- Total Buildings Card -->
    <div class="flex flex-col gap-y-6 p-7 bg-white border border-gray-200  rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="inline-flex items-center">
        <span class="w-3 h-3 bg-red-500 rounded-full me-3"></span>
        <span class="text-sm font-semibold uppercase text-gray-600 dark:text-neutral-400">Total Buildings</span>
      </div>
      <div class="text-center">
        <h3 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-800 dark:text-neutral-200">
          {{ $totalBuildings }}
        </h3>
      </div>
    </div>

    <!-- Total Reports Card -->
    <div class="flex flex-col gap-y-6 p-7 bg-white border border-gray-200  rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="inline-flex items-center">
        <span class="w-3 h-3 bg-green-500 rounded-full me-3"></span>
        <span class="text-sm font-semibold uppercase text-gray-600 dark:text-neutral-400">Total Report</span>
      </div>
      <div class="text-center">
        <h3 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-800 dark:text-neutral-200">
          {{ $totalReports }}
        </h3>
      </div>
    </div>

    <!-- Total Users Card -->
    <div class="flex flex-col gap-y-6 p-7 bg-white border border-gray-200  rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="inline-flex items-center">
        <span class="w-3 h-3 bg-orange-500 rounded-full me-3"></span>
        <span class="text-sm font-semibold uppercase text-gray-600 dark:text-neutral-400">Total User</span>
      </div>
      <div class="text-center">
        <h3 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-800 dark:text-neutral-200">
          {{ $totalUsers }}
        </h3>
      </div>
    </div>

    <!-- Total Facilities Card -->
    <div class="flex flex-col gap-y-6 p-7 bg-white border border-gray-200  rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="inline-flex items-center">
        <span class="w-3 h-3 bg-blue-500 rounded-full me-3"></span>
        <span class="text-sm font-semibold uppercase text-gray-600 dark:text-neutral-400">Total Facilities</span>
      </div>
      <div class="text-center">
        <h3 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-800 dark:text-neutral-200">
          {{ $totalFacilities }}
        </h3>
      </div>
    </div>

    <!-- Total Feedback Card -->
    <div class="flex flex-col gap-y-6 p-7 bg-white border border-gray-200  rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="inline-flex items-center">
        <span class="w-3 h-3 bg-purple-500 rounded-full me-3"></span>
        <span class="text-sm font-semibold uppercase text-gray-600 dark:text-neutral-400">Total Feedback</span>
      </div>
      <div class="text-center">
        <h3 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-800 dark:text-neutral-200">
          {{ $totalFeedbacks }}
        </h3>
      </div>
    </div>

    <!-- Total Repair Card -->
    <div class="flex flex-col gap-y-6 p-7 bg-white border border-gray-200  rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
      <div class="inline-flex items-center">
        <span class="w-3 h-3 bg-pink-500 rounded-full me-3"></span>
        <span class="text-sm font-semibold uppercase text-gray-600 dark:text-neutral-400">Total Repair</span>
      </div>
      <div class="text-center">
        <h3 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-800 dark:text-neutral-200">
          {{ $totalRepairs }}
        </h3>
      </div>
    </div>

  </div>

</div>

    <!-- End Card Section -->

    <div class="p-4 md:p-6 w-[1300px] bg-white border border-gray-200  rounded-2xl dark:bg-neutral-900 dark:border-neutral-800 mx-auto">
  <div class="mb-4">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Analytics Overview</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400">Grafik data aktivitas pengguna</p>
  </div>

  <!-- Chart Container -->
  <div id="hs-multiple-area-charts" class="w-full h-64"></div>
</div>


</div>
<!-- End Card --></div>
</div>

<script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

<script>
  window.addEventListener('load', () => {
    (function () {
      buildChart('#hs-multiple-area-charts', (mode) => ({
        chart: {
          height: 400, // Lebih tinggi
          type: 'area',
          toolbar: { show: false },
          zoom: { enabled: false }
        },
        series: [
          {
            name: 'Feedback Avg',
            data: [4.1, 4.3, 4.5, 4.2, 4.6, 4.4, 4.3, 4.5, 4.7, 4.6, 4.4, 4.5]
          },
          {
            name: 'Report Avg',
            data: [22, 18, 25, 27, 24, 20, 26, 23, 28, 29, 22, 21]
          }
        ],
        legend: { show: true },
        dataLabels: { enabled: false },
        stroke: {
          curve: 'straight', // Lebih halus
          width: 2
        },
        grid: { strokeDashArray: 2 },
        fill: {
          type: 'gradient',
          gradient: {
            type: 'vertical',
            shadeIntensity: 1,
            opacityFrom: 0.3,
            opacityTo: 0.8,
            stops: [0, 100]
          }
        },
        xaxis: {
          type: 'category',
          tickPlacement: 'on',
          categories: [
            'Jan Week 1', 'Jan Week 2', 'Jan Week 3', 'Jan Week 4',
            'Feb Week 1', 'Feb Week 2', 'Feb Week 3', 'Feb Week 4',
            'Mar Week 1', 'Mar Week 2', 'Mar Week 3', 'Mar Week 4'
          ],
          axisBorder: { show: false },
          axisTicks: { show: false },
          crosshairs: {
            stroke: { dashArray: 0 },
            dropShadow: { show: false }
          },
          tooltip: { enabled: false },
          labels: {
            style: {
              colors: 'blue',
              fontSize: '13px',
              fontFamily: 'Arial, sans-serif',
              fontWeight: 400
            }
          }
        },
        yaxis: {
          labels: {
            align: 'left',
            style: {
              colors: '#3b82f6',
              fontSize: '13px',
              fontFamily: 'Arial, sans-serif',
              fontWeight: 400
            },
            formatter: (value) => value.toFixed(1)
          }
        },
        tooltip: {
          y: {
            formatter: (value) => value.toFixed(2)
          },
          custom: function (props) {
            const { series, seriesIndex, dataPointIndex } = props;
            const label = props.series[seriesIndex][dataPointIndex].toFixed(2);
            const title = props.ctx.opts.xaxis.categories[dataPointIndex];
            const seriesName = props.ctx.opts.series[seriesIndex].name;
            return `<div class="p-2 text-sm">
                      <strong>${title}</strong><br>
                      ${seriesName}: <span class="font-semibold">${label}</span>
                    </div>`;
          }
        },
        responsive: [{
          breakpoint: 568,
          options: {
            chart: { height: 400 },
            xaxis: {
              labels: {
                style: {
                  colors: '#3b82f6',
                  fontSize: '11px',
                  fontFamily: 'Arial, sans-serif',
                  fontWeight: 400
                },
                formatter: (title) => title.slice(0, 3)
              }
            },
            yaxis: {
              labels: {
                align: 'left',
                style: {
                  colors: '#3b82f6',
                  fontSize: '11px',
                  fontFamily: 'Arial, sans-serif',
                  fontWeight: 400
                },
                formatter: (value) => value.toFixed(1)
              }
            }
          }
        }]
      }), {
        colors: ['#3b82f6', '#3b82f6'], // Biru dan Ungu
        fill: {
          gradient: {
            shadeIntensity: 0.3,
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [0, 100]
          }
        },
        xaxis: {
          labels: { style: { colors: '#9ca3af' } }
        },
        yaxis: {
          labels: { style: { colors: '#9ca3af' } }
        },
        grid: {
          borderColor: '#e5e7eb'
        }
      }, {
        colors: ['#3b82f6', '#8b5cf6'], // Mode gelap juga biru-ungu
        xaxis: {
          labels: { style: { colors: '#a3a3a3' } }
        },
        yaxis: {
          labels: { style: { colors: '#a3a3a3' } }
        },
        grid: {
          borderColor: '#6366f1'
        }
      });
    })();
  });
</script>


