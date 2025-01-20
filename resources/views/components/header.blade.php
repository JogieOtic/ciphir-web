<header class="wrapper">
  <div class="brand">
    <img src="/img/Web System logo.png" alt="CIPHIR Logo">
    <div class="flex place-items-center text-base">
      <p>Empowering Communities<br>Through Connection and Collaboration</p>
    </div>
  </div>

  @if(Request::is('/'))
    <ul class="main-link">
      <a href="#public-safety">
        <li class="main-li-btn">About Us</li>
      </a>
      <a href="#news-updates">
        <li class="main-li-btn">Infrastructure</li>
      </a>
      <a href="https://www2.naga.gov.ph/emergency-hotline/" target="_blank">
        <li class="main-li-btn">Emergency Hotlines</li> 
      </a>
    </ul>
  @elseif(Request::is('login'))
    <a href="/" class="flex items-center">
      <div class="h-fit py-2 flex items-center px-6 font-inter text-md border hover:border-slate-400 hover:bg-slate-600/50 rounded-full text-white transition ease-in duration-300">
        <span>
          <i class="fa-solid fa-house pr-2"></i> Go home
        </span>
      </div>
    </a>
  @else
    <div class="profile-btn">
      <button data-modal-target="notification-modal" data-modal-hide="profile-modal" data-modal-toggle="notification-modal" class="flex flex-row-reverse" type="button">
        <i class="fas fa-bell text-3xl text-slate-200 hover:text-slate-400"></i><div class="w-6 h-6 max-w-12 p-1 rounded-full flex items-center justify-center z-20 -mr-2 text-white text-sm bg-red-600">{{ $reportsNotif[0]->unresolved_count }}</div>
      </button>
      <button data-modal-target="profile-modal" data-modal-hide="notification-modal" data-modal-toggle="profile-modal" class="block" type="button">
        <i class="fas fa-user-circle text-3xl text-slate-200 hover:text-slate-400"></i>
      </button>
    </div>
    <!-- Profile Modal -->
    <div id="profile-modal" data-modal-placement="top-right" tabindex="-1" class="pt-20 fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
      <div class="relative w-full max-w-sm max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                  <h3 class="text-xl font-medium text-gray-900">
                      Administrator
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="profile-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5 space-y-4">
                  <div
                    class="bg-slate-400 w-32 h-32 mx-auto rounded-full shadow-inner"
                    style="background-image: url('{{ asset('img/defaultProfile.jpg') }}');
                          background-position: center;
                          background-repeat: no-repeat;
                          background-size: 200%;
                          position: relative;">
                  </div>
                  <p class="text-lg leading-relaxed text-gray-800 text-center tracking-widest font-inter font-medium pb-2">
                    {{ $user->Username }}
                  </p>
                  <div class="w-full flex justify-center">
                    <a href="/profile/{{ $user->Admin_ID }}/edit" target="_blank" class="border border-slate-700 hover:bg-slate-300 w-fit h-fit px-6 py-2 rounded-3xl">
                    Manage your Account
                    </a>
                  </div>

              </div>
              <!-- Modal footer -->
              <form method="POST" action="{{ route('logout') }}" class="p-2">
                @csrf
                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
                  <button data-modal-hide="profile-modal" type="submit" class="hover:bg-blue-700 bg-blue-600 w-1/2 text-slate-200 rounded-md py-1 mx-auto">Logout</button>
                </div>
              </form>


          </div>
      </div>
    </div>
    <!-- end of Profile Modal-->
    <!--==================================================================-->
    <!-- Notification Modal -->
    <div id="notification-modal" data-modal-placement="top-right" tabindex="-1" class="pt-20 fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-hidden h-screen">
    <div class="relative w-full max-w-sm bg-white rounded-lg shadow">
        <!-- Modal content -->
        <div class="relative max-h-[75vh] overflow-y-auto">
            <!-- Modal body -->
              <div class="p-4 md:p-5 space-y-4">
                @if($reportsNotif->isEmpty())
                  <p>No reports pending for more than 24 hours.</p>
                @else
                <div class="text-sm font-normal">Reminder: Your report is still pending for the past 24 hours.</div>
                  @foreach ($reportsNotif as $report)
                    <div id="toast-notification" class="w-full p-4 text-gray-900 bg-white rounded-lg shadow hover:bg-gray-200 cursor-pointer" role="alert">
                      <div class="flex items-center">
                          <div class="relative inline-block shrink-0 text-center"><span class="text-sm">Report</span> <br> <span class="mx-auto font-semibold text-lg">{{ $report->report_no }}</span>
                          </div>
                          <div class="ms-3 text-sm font-normal">
                              <div class="text-base font-semibold text-gray-900">{{$report->username}}</div>
                              <span class="text-xs font-medium text-blue-600 dark:text-blue-500"><em>Status:</em> {{ $report->reportStatus }}</span>
                              <span class="text-xs font-medium text-blue-600 dark:text-blue-500"><em>Priority:</em> {{ $report->priorityLevel }}</span>
                          </div>
                      </div>
                    </div>
                  @endforeach
                @endif
          </div>
      </div>
    </div>
    <!-- End of Notification Modal -->
  @endif
</header>
<script>
  console.log(@json($reportsNotif[0]->unresolved_count))
</script>
