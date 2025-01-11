<div class="sidebar fixed flex flex-col justify-between">
	<div>
		<div class="text-layout font-bold text-xl flex justify-center">
			<x-eye-logo />
		</div>
		<ul class="w-56 text-slate-900 my-3">
			<a href="/dashboard" id="homelink">
				<li class="nav-btn {{ Request::is('sa-dashboard') ? 'bg-slate-700 text-slate-100' : '' }}">
					Dashboard
				</li>
			</a>
			<a href="/manage-all-users" id="manage-all-users">
				<li class="nav-btn {{ Request::is('manage-all-users') ? 'bg-slate-700 text-slate-100' : '' }}">
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
		</ul>
	</div>
	<div class="w-full pb-8">
		<form method="POST" action="{{ route('logout') }}" class="p-2">
			@csrf
			<button type="submit" class="bg-slate-600 hover:bg-slate-700 w-full text-slate-200 rounded-md py-1.5">Logout</button>
		</form>
	</div>
</div>