<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
		<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
		<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
		<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<ul class="page-sidebar-menu auto-select-sidebar-nav" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
			<li class="sidebar-toggler-wrapper">
				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				<div class="sidebar-toggler">
				</div>
				<!-- END SIDEBAR TOGGLER BUTTON -->
			</li>
			<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
			<li class="sidebar-search-wrapper">
				<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
				<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
				<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
				<form class="sidebar-search " action="extra_search.html" method="POST">
					<a href="javascript:;" class="remove">
					<i class="icon-close"></i>
					</a>
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
						<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
						</span>
					</div>
				</form>
				<!-- END RESPONSIVE QUICK SEARCH FORM -->
			</li>
			<li class="start active open">
				<a href="javascript:;">
				<i class="icon-home"></i>
				<span class="title">Dashboard</span>
				<span class="selected"></span>
				<span class="arrow open"></span>
				</a>
			</li>
			<li>
				<a href="{{url('admin/blocks')}}">
				<i class="icon-rocket"></i>
				<span class="title">Block Management</span>
				</a>
			</li>
			<li>
				<a href="{{url('admin/institution')}}">
				<i class="icon-rocket"></i>
				<span class="title">Institution Management</span>
				</a>
			</li>
			<li>
				<a href="{{url('admin/faculty')}}">
				<i class="icon-diamond"></i>
				<span class="title">Faculty Management</span>
				</a>
			</li>
			<li>
				<a href="{{url('admin/subject')}}">
				<i class="icon-puzzle"></i>
				<span class="title">Subject Management</span>
				</a>
			</li>
			<li>
				<a href="{{url('admin/programs')}}">
				<i class="icon-puzzle"></i>
				<span class="title">Program Management</span>
				</a>
			</li>
			<!-- BEGIN ANGULARJS LINK -->
			<li>
				<a href="{{url('/admin/rooms')}}">
				<i class="icon-paper-plane"></i>
				<span class="title">
				Room Management </span>
				</a>
			</li>
			<li>
				<a href="{{url('/admin/semesters')}}">
				<i class="icon-paper-plane"></i>
				<span class="title">
				Semester Management </span>
				</a>
			</li>
			<li>
				<a href="javascript:;">
				<i class="icon-paper-plane"></i>
				<span class="title">
				Set Priority </span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="{{url('/admin/set-priority/faculties')}}">
						<i class="icon-home"></i>
						Assign Faculty</a>
					</li>
					<li>
						<a href="{{url('/admin/set-priority/subjects')}}">
						<i class="icon-basket"></i>
						Assign Subject</a>
					</li>
				</ul>
			</li>
			<li>
					<a href="javascript:;">
					<i class="icon-basket"></i>
					<span class="title">Schedules</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="/admin/class-size">
							<i class="icon-home"></i>
							Class Size</a>
						</li>
						<li>
							<a href="{{url('/admin/fixed-class-schedule')}}">
							<i class="icon-basket"></i>
							Set Fix schedules</a>
						</li>
					</ul>
				</li>
			<!-- END ANGULARJS LINK -->
			<li class="heading">
				<h3 class="uppercase">Account Settings</h3>
			</li>
			<li>
				<a href="javascript:;">
				<i class="icon-settings"></i>
				<span class="title">Form Stuff</span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="form_controls_md.html">
						<span class="badge badge-roundless badge-danger">new</span>Material Design<br>
						Form Controls</a>
					</li>
					<li>
						<a href="form_controls.html">
						Bootstrap<br>
						Form Controls</a>
					</li>
					<li>
						<a href="form_icheck.html">
						iCheck Controls</a>
					</li>
					<li>
						<a href="form_layouts.html">
						Form Layouts</a>
					</li>
					<li>
						<a href="form_editable.html">
						<span class="badge badge-roundless badge-warning">new</span>Form X-editable</a>
					</li>
					<li>
						<a href="form_wizard.html">
						Form Wizard</a>
					</li>
					<li>
						<a href="form_validation.html">
						Form Validation</a>
					</li>
					<li>
						<a href="form_image_crop.html">
						<span class="badge badge-roundless badge-danger">new</span>Image Cropping</a>
					</li>
					<li>
						<a href="form_fileupload.html">
						Multiple File Upload</a>
					</li>
					<li>
						<a href="form_dropzone.html">
						Dropzone File Upload</a>
					</li>
				</ul>
			</li>
		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>
<!-- END SIDEBAR -->