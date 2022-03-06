	<header>
	<!-- Header desktop -->
	@php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    <div class="container-menu-desktop">
			<!-- Topbar -->
			
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="#" class="logo">
						<img src="/templates/images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="/">Trang chủ</a>
								{!!$menusHtml!!}
							</li>
						

							
							<li>
								<a href="about.html">Thông tin</a>
							</li>

							<li>
								<a href="contact.html">Liên hệ</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
								data-notify="{{!is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
								<!-- \Illuminate\Support\Facades -->
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.html"><img src="/templates/images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			

			<ul class="main-menu-m">
			<li class="active-menu">
								<a href="/">Trang chủ</a>
								{!!$menusHtml!!}
							</li>
						

							
							<li>
								<a href="about.html">Thông tin</a>
							</li>

							<li>
								<a href="contact.html">Liên hệ</a>
							</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="/templates/images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15" method="post" >
					{{csrf_field()}}
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i> 
					</button>
					<input class="plh3 search-input" type="text" id="keywords" name="search" placeholder="Search...">
					<div id="search-ajax"></div>
				</form>
			</div>
		</div>
		</header>