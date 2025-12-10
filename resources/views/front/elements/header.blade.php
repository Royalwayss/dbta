<button onclick="scrollToTop()" id="scrollTopBtn" title="Go to top">
  <i class="fas fa-arrow-up"></i>
   </button>
	<header>
		<div class="header_bar">
			<nav class="navbar navbar-expand-lg navbar-dark bottom-header">
				<div class="container">
					<div class="dtba_logo">
						<a href="{{ route('home') }}"><img src="front/assets/images/logo-dtba.png" alt="Logo"></a>
					</div>

					<button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
						data-bs-target="#mainNavbar">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
						<ul class="navbar-nav">
						<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="javascript:void(0)">About Us</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="{{ route('aboutus') }}">About Us</a></li>
									<li><a class="dropdown-item" href="{{ route('committes') }}">List of DTBA Committees</a></li>
								</ul>
							</li> 
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="javascript:void(0)"
									data-bs-toggle="dropdown">Learning</a>
								 <?php $meeting_types = meeting_types(); ?>
								<ul class="dropdown-menu">
									@foreach($meeting_types as $key=>$meeting_type)
									<li><a class="dropdown-item" href="{{ url($meeting_type['slug']) }}">{{ $meeting_type['name'] }}</a></li>
									@endforeach
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="{{ route('newsletter') }}">Newsletter & Publications</a>
							</li>
							<li class="nav-item"><a class="nav-link" href="{{ route('executive') }}">Executive Committee</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('new_membership') }}">Membership</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('contactus') }}">Contact</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('downloads') }}">Downloads</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('media') }}">Media</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('case_laws') }}">Case Laws</a></li>
							<!-- <div class="login_btn mobile_view_show">
								<a href="#">Login</a>
							</div> -->
						</ul>

					</div>
					<!-- <div class="login_btn mobile_view">
						<a href="#">Login</a>
					</div> -->
				</div>
			</nav>
		</div>
	</header>
	