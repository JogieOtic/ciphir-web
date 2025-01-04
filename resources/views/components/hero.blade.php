<section class="hero">
  <div class="left-side">
    <div class="flex flex-col w-full">
      <div class="pb-8">
        <h1 class="text-7xl font-bold py-6">CIPHIR</h1>
        <h2 class="text-2xl">
          Centralized Information Platform for<br>
          Community Hazards and <br>
          Infrastructure Reports <br>
        </h2>
        <hr class="w-80 h-0.5 my-4 bg-gray-100 border-0 rounded dark:bg-gray-700">
      </div>
      @if (Auth::check())
        <a href="/dashboard" class="link">
          <div class="main-hero-btn">Go to dashboard
            <i class="fa-solid fa-arrow-right-to-bracket text-base"></i>
          </div>
        </a>
      @else
        <a href="/login" class="link">
          <div class="main-hero-btn">Login
          </div>
        </a>
      @endif
    </div>
  </div>
  <div class="right-side">
    <img src="{{ asset('img/designimage.jpg') }}" type="image/png" class=""/>
  </div>
</section>