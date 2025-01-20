<div class="sidebar fixed flex flex-col justify-between text-base">
	<div>
		<div class="text-layout font-bold text-xl flex justify-center">
			<x-eye-logo />
		</div>
		<ul class="w-56 text-slate-900 my-3">
			<a href="/sa-dashboard" id="dashboardlink">
				<li class="nav-btn {{ Request::is('sa-dashboard') ? 'bg-slate-700 text-slate-100' : '' }}">
					Dashboard
				</li>
			</a>
			<a href="/manage-all-users/administrators" id="manage-all-users">
				<li class="nav-btn {{ Request::is('manage-all-users/*') ? 'bg-slate-700 text-slate-100' : '' }}">
					Manage Users
				</li>
			</a>
			<a href="/manage/issues" id="manage-entities">
				<li class="nav-btn {{ Request::is('manage/*') ? 'bg-slate-700 text-slate-100' : '' }}">
					Manage Report Entities
				</li>
			</a>
			<a href="/sa-profile" id="profilelink">
				<li class="nav-btn {{ Request::is('sa-profile') ? 'bg-slate-700 text-slate-100' : '' }}">
					Profile
				</li>
			</a>
		</ul>
	</div>
	<div class="w-full pb-8 px-2">
		<form method="POST" action="{{ route('logout') }}" class="p-2">
			@csrf
			<button type="submit" class="!bg-slate-600 hover:!bg-slate-900 w-full text-slate-200 rounded-md py-1.5">Logout</button>
		</form>
	</div>
</div>