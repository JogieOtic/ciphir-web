<nav>
		@if(Auth::User()->Role === 'SA')
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
		@else
			<div class="sidebar">
				<ul class="w-56 text-slate-900">
					<a href="/dashboard" id="homelink">
						<li class="nav-btn">
								<i class="fas fa-dashboard"></i>Dashboard
						</li>
					</a>
					<li>
						<a href="/newreport" class="nav-btn" id="newreportlink">
							<i class="fas fa-file-alt"></i>New Reports
						</a>
					</li>
					<li>
						<a href="/priorityreport" class="nav-btn" id="priorityreport">
							<i class="fas fa-exclamation-circle"></i>Priority Report
						</a>
					</li>
					<li>
						<a href="/reporthistory" class="nav-btn" id="reporthistory">
							<i class="fas fa-history"></i>Report History
						</a>
					</li>
				</ul>
			</div>
		@endif
</nav>
