<?php include 'app/info.php'; ?>
		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><i class="fa fa-map-marker"></i><?php _($app_address) ?></li>
									<li><a href="tel: <?php _($app_phone) ?>"><i class="fa fa-phone"></i><?php _($app_phone) ?></a></li>
									<li><a href="mailto: <?php _($app_email) ?>"><i class="fa fa-envelope-o"></i><?php _($app_email) ?></a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Free Deals</h3>
								<ul class="footer-links">
									<li><a href="/about-us">About Us</a></li>
									<li><a href="/blog">Blog</a></li>
									<li><a href="/faq">FAQ</a></li>
									<li><a href="/orders-and-returns">Orders and Returns</a></li>
									<li><a href="/submit-an-offer">Submit an Offer</a></li>
									<li><a href="/terms-and-conditions">Terms and Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Support</h3>
								<ul class="footer-links">
									<li><a href="/contact-us">Contact Us</a></li>
									<li><a href="/connect">Connect</a></li>
									<li><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="/my-account">My Account</a></li>
									<li><a href="/track-my-order">Track My Order</a></li>
									<li><a href="/cart">View Cart</a></li>
									<!-- <li><a href="/wishlist">Wishlist</a></li> -->
									<li><a href="/help">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Developed by <a href="https://pointsource.ng" target="_blank">Pointsource</a>
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="<?php assets('js/jquery.min.js') ?>"></script>
		<script src="<?php assets('js/bootstrap.min.js') ?>"></script>
		<script src="<?php assets('js/slick.min.js') ?>"></script>
		<script src="<?php assets('js/nouislider.min.js') ?>"></script>
		<script src="<?php assets('js/jquery.zoom.min.js') ?>"></script>
		<script src="<?php assets('js/main.js') ?>"></script>

	</body>
</html>