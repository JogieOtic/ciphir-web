<section class="stats-container">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <div class="stat-item max-w-fit">
    <h3 class="stat-label">Infrastructure Report Statistics</h3>
    <div class="max-w-fit h-72 flex py-6 px-8 gap-8 text-gray-800">
        <canvas id="donut-chart" class="drop-shadow-xl"></canvas>
        <div class="flex justify-center flex-col">
          <label for="Total" class="text-layout font-normal">
            Total Reports
          </label>
          <span class="font-bold text-6xl">
            {{ $IRS->sum('total') }}
          </span>
        </div>
    </div>
    <div>
      <!-- Infrastructure Report Statistics -->
      <div class="infrastructure-statistics">
        <ul class="flex flex-col gap-2 text-layout text-gray-800">
            @foreach ($infrastructureReports as $report)
                <li class="border-b flex justify-between font-semibold font-roboto">
                  <div class="flex gap-3 text-center">
                    <i class="fa-solid fa-square text-3xl drop-shadow-sm my-auto" style="color:{{$report->color_code}};"></i>
                    <div class="my-auto">
                      <h4>{{ $report->name }}</h4>
                    </div>
                  </div>
                  <p class="my-auto px-4">{{ $report->total }}</p>
                </li>
            @endforeach
        </ul>
      </div>
    </div>
  </div>

  {{-- barangay stats --}}
  <div class="stat-item max-h-fit max-w-full">
    <h3 class="stat-label">Barangay Report Statistics</h3>
    <div>
      <!-- Infrastructure Report Statistics -->
      <div class="infrastructure-statistics px-8">
        
        <div class="drop-shadow-xl w-full flex flex-col">
          @foreach ($barangay as $item)
            @if($item->report_count > 0)
              <div class="font-medium text-blue-100 text-nowrap pb-2">
                <span class="text-lg pl-2 font-bold text-slate-900">{{$item->barangay_name}}</span>
                <div class="w-full flex flex-row rounded-full bg-slate-900 p-1">
                  <div class="bg-blue-600 text-base text-center p-0.5 leading-none rounded-full" style="width: 
                    {{$item->percentage}}%"> {{number_format($item->percentage, 0)}}%
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>

      </div>
    </div>
  </div>
  

  <script>
    // Get the canvas element
    var canvas = document.getElementById('donut-chart');
    const reportsData = @json($IRS);
    const labels = [];
    const stat = [];
    const color_code = [];

    // Append 'name' values to the labels array
    reportsData.forEach((element) => {
        labels.push(element.name);
        stat.push(element.total);
        color_code.push(element.color_code);
    });

      // Set the chart data
      var data = {
          labels: labels,
          datasets: [{
              label: 'Total',
              data: stat,
              backgroundColor: color_code,
              hoverOffset: 4
          }]
      };

      // Set the chart options
      var options = {
          plugins: {
              legend: {
                  display: false
              }
          },
          aspectRatio: 1,
          cutout: '50%',
          animation: {
              animateRotate: false
          }
      };

      // Create the chart
      var chart = new Chart(canvas, {
          type: 'doughnut',
          data: data,
          options: options
      });
  </script>

</section>
