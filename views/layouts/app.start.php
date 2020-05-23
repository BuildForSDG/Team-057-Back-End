<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		 <title>
			<?php _($_SESSION['nav']['Page Title']) ?>
		</title>
        
        <link rel="shortcut icon" href="<?php assets('img/favicon.png') ?>" type="image/x-icon">

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="<?php assets('css/bootstrap.min.css') ?>"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="<?php assets('css/slick.css') ?>"/>
		<link type="text/css" rel="stylesheet" href="<?php assets('css/slick-theme.css') ?>"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="<?php assets('css/nouislider.min.css') ?>"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="<?php assets('css/font-awesome.min.css') ?>">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="<?php assets('css/style.css') ?>"/>

		<!-- My Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="<?php assets('css/main.css') ?>"/>

		<script>
			let _$ = (selector) => document.querySelector(selector);
		</script>

		<!-- HTML5 shim and Respond.js') ?> for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js') ?> doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="tel: <?php _($app_phone) ?>"><i class="fa fa-phone"></i> <?php _($app_phone) ?></a></li>
						<li><a href="mailto: <?php _($app_email) ?>"><i class="fa fa-envelope-o"></i> <?php _($app_email) ?></a></li>
						<li><i class="fa fa-map-marker"></i> <span style="color: white; font-size: inherit;"><?php _($app_address) ?></span></li>
					</ul>

					<?php $user = new User(); ($user->authed()) ? component('nav-auth') : component('nav-unauth') ; ?>

				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="./" class="logo">
									<img src="<?php assets('img/logo.png') ?>" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="all-categories">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<!-- <div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div> -->
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a href="/cart">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty" <?php $cart = new Cart(); ($cart->itemCount() < 1) ? _('style="display: none;"') : _(''); ?>><?php _($cart->itemCount()); ?></div>
									</a>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<?php component('app-nav') ?>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
        <!-- /NAVIGATION -->
       