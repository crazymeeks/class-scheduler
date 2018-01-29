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
		<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
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
				<a href="{{url('admin/institution')}}">
				<i class="icon-rocket"></i>
				<span class="title">Institution</span>
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
			<!-- BEGIN ANGULARJS LINK -->
			<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="AngularJS version demo">
				<a href="angularjs" target="_blank">
				<i class="icon-paper-plane"></i>
				<span class="title">
				Set Priority </span>
				</a>
			</li>
			<li>
				<a href="javascript:;">
				<i class="icon-basket"></i>
				<span class="title">Schedules</span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="ecommerce_index.html">
						<i class="icon-home"></i>
						Dashboard</a>
					</li>
					<li>
						<a href="ecommerce_orders.html">
						<i class="icon-basket"></i>
						Orders</a>
					</li>
					<li>
						<a href="ecommerce_orders_view.html">
						<i class="icon-tag"></i>
						Order View</a>
					</li>
					<li>
						<a href="ecommerce_products.html">
						<i class="icon-handbag"></i>
						Products</a>
					</li>
					<li>
						<a href="ecommerce_products_edit.html">
						<i class="icon-pencil"></i>
						Product Edit</a>
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