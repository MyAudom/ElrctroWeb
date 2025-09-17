<?php include 'head.php' ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<?php include 'icon.php' ?>
		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!-- [if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> -->
		<title>Home - Electro.</title>
	</head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +885 619 545 12</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> audomhengsr@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Siem Reap</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="signin.php"><i class="fa fa-user-o"></i> My Account</a></li>
					</ul>
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
								<a href="index.php" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input mt-1" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">3</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
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
						<li class="active"><a href="index.php">Home</a></li>
						<li><a href="<?php echo cleanUrl('store.php'); ?>">store</a></li>
						<li><a href="<?php echo cleanUrl('laptop.php'); ?>">Laptops</a></li>
						<li><a href="<?php echo cleanUrl('smartphones.php'); ?>">Smartphones</a></li>
						<li><a href="camera.php">Cameras</a></li>
						<li><a href="accessories.php">Accessories</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-4">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop01.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Laptop<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-4">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop03.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Accessories<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-4">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop02.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Cameras<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->
										<?php
											$sql = "SELECT discount, image, category, price, after_the_discount, products FROM fornend_database_products LIMIT 7";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													echo '<div class="col-md-4 col-xs-6">';
													echo '    <div class="product">';
													echo '        <div class="product-img">';
													echo '            <img src="' . $row["image"] . '" alt="">';
													echo '            <div class="product-label">';
													if ($row["discount"]) {
														echo '                <span class="sale">'. '-' . $row["discount"].'%' .'</span>';
													}
													echo '            </div>';
													echo '        </div>';
													echo '        <div class="product-body">';
													echo '            <p class="product-category">' . $row["category"] . '</p>';
													echo '            <h3 class="product-name"><a href="#">' . $row["products"] . '</a></h3>';
													echo '            <h4 class="product-price">$' . $row["after_the_discount"] . ' <del class="product-old-price">$' . $row["price"] . '</del></h4>';
													echo '            <div class="product-rating">';
													echo '                <i class="fa fa-star"></i>';
													echo '                <i class="fa fa-star"></i>';
													echo '                <i class="fa fa-star"></i>';
													echo '                <i class="fa fa-star"></i>';
													echo '                <i class="fa fa-star"></i>';
													echo '            </div>';
													echo '            <div class="product-btns">';
													echo '                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>';
													echo '                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>';
													echo '                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>';
													echo '            </div>';
													echo '        </div>';
													echo '        <div class="add-to-cart">';
													echo '            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>';
													echo '        </div>';
													echo '    </div>';
													echo '</div>';
												}
											} else {
												echo "0 results";
											}
										?>
										<!-- /product -->
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section col-xs-12">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
						<?php
							// កំណត់ម៉ោងបញ្ចប់ (អាចកំណត់ជាដោយខ្លួនឯង)
							$end_time = strtotime('2025-12-31 23:59:59'); // ត្រូវប្តូរតាមតម្រូវការ
							?>
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3 id="days">00</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="hours">00</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="minutes">00</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="seconds">00</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="#">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>
						<?php
							$sql = "SELECT discount, image, category, price, after_the_discount, products FROM fornend_database_products WHERE after_the_discount >= 600 LIMIT 7";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo '<div class="product-widget">';
									echo '    <div class="product-img">';
									echo '        <img src="' . $row["image"] . '" alt="">';
									echo '    </div>';
									echo '    <div class="product-body">';
									echo '        <p class="product-category">' . $row["category"] . '</p>';
									echo '        <h3 class="product-name"><a href="#">' . $row["products"] . '</a></h3>';
									echo '        <h4 class="product-price">$' . $row["after_the_discount"] . ' <del class="product-old-price">$' . $row["price"] . '</del></h4>';
									echo '    </div>';
									echo '</div>';
								}
							} else {
								echo "0 results";
							}
						?>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>
						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div>
								<?php
									$sql = "SELECT discount, image, category, price, after_the_discount, products FROM fornend_database_products WHERE after_the_discount BETWEEN 300 AND 599 LIMIT 7";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											echo '<div class="product-widget">';
											echo '    <div class="product-img">';
											echo '        <img src="' . $row["image"] . '" alt="">';
											echo '    </div>';
											echo '    <div class="product-body">';
											echo '        <p class="product-category">' . $row["category"] . '</p>';
											echo '        <h3 class="product-name"><a href="#">' . $row["products"] . '</a></h3>';
											echo '        <h4 class="product-price">$' . $row["after_the_discount"] . ' <del class="product-old-price">$' . $row["price"] . '</del></h4>';
											echo '    </div>';
											echo '</div>';
										}
									} else {
										echo "0 results";
									}
								?>
							</div>
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							<div>
								<?php
									$sql = "SELECT discount, image, category, price, after_the_discount, products FROM fornend_database_products WHERE after_the_discount BETWEEN 0 AND 299 LIMIT 7";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											echo '<div class="product-widget">';
											echo '    <div class="product-img">';
											echo '        <img src="' . $row["image"] . '" alt="">';
											echo '    </div>';
											echo '    <div class="product-body">';
											echo '        <p class="product-category">' . $row["category"] . '</p>';
											echo '        <h3 class="product-name"><a href="#">' . $row["products"] . '</a></h3>';
											echo '        <h4 class="product-price">$' . $row["after_the_discount"] . ' <del class="product-old-price">$' . $row["price"] . '</del></h4>';
											echo '    </div>';
											echo '</div>';
										}
									} else {
										echo "0 results";
									}
								?>
							</div>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form method="POST" action="index.php">
								<input class="input" type="email" name="email" placeholder="Enter Your Email" required>
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<?php
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
								$email = $_POST['email'];

								$stmt = $conn->prepare("INSERT INTO email (mail) VALUES (?)");
								$stmt->bind_param("s", $email);

								if ($stmt->execute()) {
									echo "Thank you for subscribing!";
								} else {
									echo "Error: " . $stmt->error;
								}

								$stmt->close();
							}
							?>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<?php include 'footer.php' ?>

	</body>
		<?php
			$conn->close();
		?>
	</body>
</html>
