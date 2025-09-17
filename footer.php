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
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>Siem Reap</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+588 619 545 12</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>audomhengsr@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="backend/signin.php">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
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
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
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
		<!-- JavaScript for Menu Toggle -->
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				const menuToggle = document.querySelector('.menu-toggle a');
				const responsiveNav = document.querySelector('#responsive-nav');

				menuToggle.addEventListener('click', function(event) {
					event.preventDefault(); // Prevent default anchor behavior
					responsiveNav.classList.toggle('active');
				});
			});
		</script>
		<!-- /JavaScript for Menu Toggle -->
		<script>
        	// យកម៉ោងបញ្ចប់ពី PHP
			const endTime = <?php echo $end_time; ?> * 1000; // PHP timestamp -> milliseconds

			function updateCountdown() {
				const now = new Date().getTime(); // Timestamp បច្ចុប្បន្ន
				const distance = endTime - now;

				if (distance > 0) {
					const days = Math.floor(distance / (1000 * 60 * 60 * 24));
					const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					const seconds = Math.floor((distance % (1000 * 60)) / 1000);

					document.getElementById('days').innerText = String(days).padStart(2, '0');
					document.getElementById('hours').innerText = String(hours).padStart(2, '0');
					document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
					document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
				} else {
					clearInterval(timer); // ឈប់ timer
					document.querySelector('.hot-deal-countdown').innerHTML = "<li>Deal Expired!</li>";
				}
			}

			// Update timer ជារៀងរាល់វិនាទី
			const timer = setInterval(updateCountdown, 1000);
			updateCountdown(); // ហៅម្តងដើម្បីដាក់តម្លៃចាប់ផ្តើម
		</script>
		<!-- jQuery Plugins -->
		<script src="fornend/js/jquery.min.js"></script>
		<script src="fornend/js/bootstrap.min.js"></script>
		<script src="fornend/js/slick.min.js"></script>
		<script src="fornend/js/nouislider.min.js"></script>
		<script src="fornend/js/jquery.zoom.min.js"></script>

		<script src="fornend/js/main.js"></script>
