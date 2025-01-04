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
  <div class="drop-shadow-xl w-full flex place-items-center justify-center">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.8354345094287!2d-122.41941518468146!3d37.774929779759096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085812e660b42b9%3A0xe2e4a9b5fbaaf83e!2sSan+Francisco%2C+CA!5e0!3m2!1sen!2sus!4v1631552643775!5m2!1sen!2sus" 
        width="1000" 
        height="650" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" class="rounded-md w-full h-full">
    </iframe>
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