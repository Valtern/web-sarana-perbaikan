<div><!-- Card Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">

            <!-- Total Buildings Card -->
            <div
                class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-5 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
                <div class="inline-flex justify-center items-center">
                    <span class="size-2 inline-block bg-red-500 rounded-full me-2"></span>
                    <span class="text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">Total
                        Buildings</span>
                </div>

                <div class="text-center">
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $totalBuildings }}
                    </h3>
                </div>
            </div>
            <!-- End Card -->


            <!-- Total Reports Card -->
            <div
                class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-5 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
                <div class="inline-flex justify-center items-center">
                    <span class="size-2 inline-block bg-green-500 rounded-full me-2"></span>
                    <span class="text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">Total
                        Report</span>
                </div>

                <div class="text-center">
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $totalReports }}
                    </h3>
                </div>
            </div>
            <!-- End Card -->

            <!-- Total Users Card -->
            <div
                class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-5 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
                <div class="inline-flex justify-center items-center">
                    <span class="size-2 inline-block bg-orange-500 rounded-full me-2"></span>
                    <span class="text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">Total User</span>
                </div>

                <div class="text-center">
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $totalUsers }}
                    </h3>
                </div>
            </div>
            <!-- End Card -->

            <!-- Total Facilities Card -->
            <div
                class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-5 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
                <div class="inline-flex justify-center items-center">
                    <span class="size-2 inline-block bg-blue-500 rounded-full me-2"></span>
                    <span class="text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">Total
                        Facilities</span>
                </div>

                <div class="text-center">
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $totalFacilities }}
                    </h3>
                </div>
            </div>
            <!-- End Card -->

            <!-- Total Feedback Card -->
            <div
                class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-5 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
                <div class="inline-flex justify-center items-center">
                    <span class="size-2 inline-block bg-purple-500 rounded-full me-2"></span>
                    <span class="text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">Total
                        Feedback</span>
                </div>

                <div class="text-center">
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $totalFeedbacks }}
                    </h3>
                </div>
            </div>
            <!-- End Card -->

            <!-- Total Feedback Card -->
            <div
                class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-5 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
                <div class="inline-flex justify-center items-center">
                    <span class="size-2 inline-block bg-pink-500 rounded-full me-2"></span>
                    <span class="text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">Total
                        Repair</span>
                </div>

                <div class="text-center">
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $totalRepairs }}
                    </h3>
                </div>
            </div>
        </div>        
    </div>
    <!-- End Card Section -->

   <!-- Legend Indicator -->
<div class="flex justify-center sm:justify-end items-center gap-x-4 mb-3 sm:mb-6">
    <div class="inline-flex items-center">
        <span class="size-2.5 inline-block bg-green-500 rounded-sm me-2"></span>
        <span class="text-[13px] text-gray-600 dark:text-neutral-400">
            Feedback Avg
        </span>
    </div>
    <div class="inline-flex items-center">
        <span class="size-2.5 inline-block bg-blue-500 rounded-sm me-2"></span>
        <span class="text-[13px] text-gray-600 dark:text-neutral-400">
            Report Avg
        </span>
    </div>
</div>
<!-- End Legend Indicator -->


    <div id="hs-multiple-area-charts"></div>
</div>
<!-- End Card --></div>
</div>

<script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

<script>
  window.addEventListener('load', () => {
    (function () {
      buildChart('#hs-multiple-area-charts', (mode) => ({
        chart: {
          height: 300,
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
          curve: 'straight',
          width: 2
        },
        grid: { strokeDashArray: 2 },
        fill: {
          type: 'gradient',
          gradient: {
            type: 'vertical',
            shadeIntensity: 1,
            opacityFrom: 0.1,
            opacityTo: 0.8
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
              colors: '#9ca3af',
              fontSize: '13px',
              fontFamily: 'Inter, ui-sans-serif',
              fontWeight: 400
            }
          }
        },
        yaxis: {
          labels: {
            align: 'left',
            style: {
              colors: '#9ca3af',
              fontSize: '13px',
              fontFamily: 'Inter, ui-sans-serif',
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
            chart: { height: 300 },
            xaxis: {
              labels: {
                style: {
                  colors: '#9ca3af',
                  fontSize: '11px',
                  fontFamily: 'Inter, ui-sans-serif',
                  fontWeight: 400
                },
                formatter: (title) => title.slice(0, 3)
              }
            },
            yaxis: {
              labels: {
                align: 'left',
                style: {
                  colors: '#9ca3af',
                  fontSize: '11px',
                  fontFamily: 'Inter, ui-sans-serif',
                  fontWeight: 400
                },
                formatter: (value) => value.toFixed(1)
              }
            }
          }
        }]
      }), {
        colors: ['#10b981', '#3b82f6'],
        fill: {
          gradient: {
            shadeIntensity: 0.1,
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [50, 100]
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
        colors: ['#22c55e', '#2563eb'],
        xaxis: {
          labels: { style: { colors: '#a3a3a3' } }
        },
        yaxis: {
          labels: { style: { colors: '#a3a3a3' } }
        },
        grid: {
          borderColor: '#404040'
        }
      });
    })();
  });
</script>

