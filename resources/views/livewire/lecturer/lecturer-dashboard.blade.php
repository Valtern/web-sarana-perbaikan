<div>
  <div>
  <div class="max-w-7xl mx-auto grid grid-cols-1 gap-6">
    <!-- Profile (Expanded Full Width) -->
    <div class="p-6 shadow bg-blue-600 dark:bg-blue-900 bg-[url('https://preline.co/assets/svg/examples/abstract-1.svg')] bg-no-repeat bg-cover bg-center rounded-3xl text-left text-white">
  <div class="flex items-center gap-4 justify-between">
    <div>
      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white dark:text-white mb-6">
        Welcome <span class="text-yellow-200">{{ $user->name }}</span>
      </h1>
      <p class="max-w-xl text-base text-white dark:text-gray-300">
        Welcome, <span class="font-semibold text-yellow-200 dark:text-white">{{ $user->name }}</span>! You have successfully logged in as a <span class="font-medium text-yellow-200 dark:text-blue-400 capitalize">{{ $user->role }}</span>. We're excited to have you on board. All your activities and notifications will be sent to your registered email address at <a href="mailto:{{ $user->email }}" class="text-yellow-200 dark:text-blue-400 underline hover:no-underline">{{ $user->email }}</a>. Feel free to explore the platform and make the most out of your experience!
      </p>
    </div>
    <img src="{{ $user->profile_picture_url }}" alt="Profile Picture" class="w-50 h-60 rounded-lg object-cover">
  </div>
</div>


    <!-- Schedule + Contacts side-by-side -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Class Schedule -->
     <div class="col-span-2 p-6 rounded-2xl  border border-gray-300 dark:border-neutral-600 bg-white dark:bg-neutral-800 text-gray-900 dark:text-white">
    <h3 class="text-lg font-semibold mb-4">Report History</h3>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left">
                <th class="pb-2 text-blue-700">Facility Name</th>
                <th class="pb-2 text-blue-700">Created</th>
                <th class="pb-2 text-blue-700">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr class="border-t">
                <td class="py-2">{{ $report->facility_name }}</td>
                <td class="py-2">{{ $report->created_at->format('d M, H:i') }}</td>
                <td class="py-2">{{ $report->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


      <!-- Status -->
     <div class="p-6 rounded-2xl  border border-gray-300 dark:border-neutral-600 bg-white dark:bg-neutral-800 text-gray-900 dark:text-white">
        <h3 class="text-lg font-semibold mb-4">Status</h3>
        <div class="flex flex-col justify-center items-center">
          <div id="hs-doughnut-chart"></div>

          <!-- Legend Indicator -->
          <div class="flex justify-center sm:justify-end items-center gap-x-4 mt-3 sm:mt-6">
            <div class="inline-flex items-center">
              <span class="size-2.5 inline-block bg-blue-600 rounded-sm me-2"></span>
              <span class="text-[13px] text-gray-600 dark:text-neutral-400">
                In Progress
              </span>
            </div>
            <div class="inline-flex items-center">
              <span class="size-2.5 inline-block bg-cyan-500 rounded-sm me-2"></span>
              <span class="text-[13px] text-gray-600 dark:text-neutral-400">
                Pending
              </span>
            </div>
            <div class="inline-flex items-center">
              <span class="size-2.5 inline-block bg-gray-300 rounded-sm me-2 dark:bg-neutral-700"></span>
              <span class="text-[13px] text-gray-600 dark:text-neutral-400">
                Solved
              </span>
            </div>
          </div>
          <!-- End Legend Indicator -->
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

<script>
  window.addEventListener('load', () => {
    // Apex Doughnut Chart
    (function () {
      buildChart('#hs-doughnut-chart', (mode) => ({
        chart: {
          height: 230,
          width: 230,
          type: 'donut',
          zoom: {
            enabled: false
          }
        },
        plotOptions: {
          pie: {
            donut: {
              size: '76%'
            }
          }
        },
        series: [47, 23, 30],
        labels: ['Tailwind CSS', 'Preline UI', 'Others'],
        legend: {
          show: false
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 5
        },
        grid: {
          padding: {
            top: -12,
            bottom: -11,
            left: -12,
            right: -12
          }
        },
        states: {
          hover: {
            filter: {
              type: 'none'
            }
          }
        },
        tooltip: {
          enabled: true,
          custom: function (props) {
            return buildTooltipForDonut(
              props,
              mode === 'dark' ? ['#fff', '#fff', '#000'] : ['#fff', '#fff', '#000']
            );
          }
        }
      }), {
        colors: ['#3b82f6', '#22d3ee', '#e5e7eb'],
        stroke: {
          colors: ['rgb(255, 255, 255)']
        }
      }, {
        colors: ['#3b82f6', '#22d3ee', '#404040'],
        stroke: {
          colors: ['rgb(38, 38, 38)']
        }
      });
    })();
  });
</script>