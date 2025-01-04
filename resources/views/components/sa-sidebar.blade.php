<div class="sidebar absolute">
  <ul class="w-56 text-slate-900">
    <li class="w-full text-center pt-4 pb-2">logo here</li>
    <li class="nav-btn">Dashboard</li>
    <li class="nav-btn">Incoming</li>
    <li class="nav-btn">Manage Users</li>
    <li class="nav-btn">Profile</li>
    <li class="w-full mt-3">
      <form method="POST" action="{{ route('logout') }}" class="p-2">
        @csrf
        <button type="submit" class="hover:bg-slate-700 bg-slate-600 w-full text-slate-200 rounded-md py-1">Logout</button>
      </form>
    </li>
  </ul>
</div>