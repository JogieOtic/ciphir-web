<div class="sidebar">
	<div class="text-layout font-bold text-xl w-full h-44 pt-14 drop-shadow-lg rounded-full shadow-inner px-4 flex justify-center">
		<x-eye-logo />
	</div>
	<ul class="w-56 text-slate-900">
		<a href="/dashboard" id="homelink">
			<li class="nav-btn {{ Request::is('dashboard') ? 'bg-slate-700 text-slate-100' : '' }}">
				<div class="icon-layout">
					<i class="fas fa-dashboard"></i>
				</div>Dashboard
			</li>
		</a>
		<a href="/newreport" id="newreportlink">
			<li class="nav-btn {{ Request::is('newreport') ? 'bg-slate-700 text-slate-100' : '' }}">
				<div class="icon-layout">
					<i class="fas fa-file-alt"></i>
				</div>New Reports
			</li>
		</a>			
		<a href="/priorityreport"id="priorityreport">
			<li class="nav-btn {{ Request::is('priorityreport') ? 'bg-slate-700 text-slate-100' : '' }}">
				<div class="icon-layout">
					<i class="fas fa-exclamation-circle"></i>
				</div>Priority Report
			</li>
		</a>
		<a href="/reporthistory" id="reporthistory">
			<li class="nav-btn {{ Request::is('reporthistory') ? 'bg-slate-700 text-slate-100' : '' }}">
				<div class="icon-layout">
					<i class="fas fa-history"></i>
				</div>Report History
			</li>
		</a>
	</ul>
</div>
