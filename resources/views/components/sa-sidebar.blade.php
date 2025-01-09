<div class="sidebar absolute">
	<div class="text-layout font-bold text-xl flex justify-center">
    <x-eye-logo />
  </div>
  <ul class="w-56 text-slate-900">
    <a href="/dashboard" id="homelink">
			<li class="nav-btn {{ Request::is('sa-dashboard') ? 'bg-slate-700 text-slate-100' : '' }}">
				Dashboard
			</li>
		</a>
    <a href="/dashboard" id="homelink">
			<li class="nav-btn {{ Request::is('sa-') ? 'bg-slate-700 text-slate-100' : '' }}">
				Manage Users
			</li>
		</a>
    <a href="/dashboard" id="homelink">
			<li class="nav-btn {{ Request::is('sa-') ? 'bg-slate-700 text-slate-100' : '' }}">
				Privileges
			</li>
		</a>
    <a href="/dashboard" id="homelink">
			<li class="nav-btn {{ Request::is('sa-') ? 'bg-slate-700 text-slate-100' : '' }}">
				Profile
			</li>
		</a>
    <li class="w-full mt-3">
      <form method="POST" action="{{ route('logout') }}" class="p-2">
        @csrf
        <button type="submit" class="hover:bg-slate-700 bg-slate-600 w-full text-slate-200 rounded-md py-1">Logout</button>
      </form>
    </li>
  </ul>
</div>