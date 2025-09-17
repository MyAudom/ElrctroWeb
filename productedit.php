<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'head.php';

// Check if the product ID is passed via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input

    // Fetch product details
    $query = "SELECT id, category, products, image, price, discount, after_the_discount FROM fornend_database_products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "No product ID specified.";
    exit();
}

// Process the form submission to update the product details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated product data
    $id = intval($_POST['id']); // Use hidden ID field from the form
    $category = $_POST['category'];
    $products = $_POST['products'];
    $price = floatval($_POST['price']);
    $discount = intval($_POST['discount']);
    $after_discount = floatval($price - ($price * $discount / 100));
    $old_image = $_POST['old_image']; // Get the old image path from the hidden input

    // Handle image upload
    $image_path = $old_image; // Default to the existing image
    if (!empty($_FILES['image']['name'])) {
        $upload_dir = "image_upload/"; // Ensure this directory exists and is writable
        $image_name = basename($_FILES['image']['name']);
        $image_path = $upload_dir . $image_name;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            // Delete the old image if it exists and is not the default image
            if ($old_image && file_exists($old_image) && $old_image !== 'default.jpg') {
                unlink($old_image); // Delete the old image file
            }
        } else {
            echo "<script>alert('Error uploading the image');</script>";
            $image_path = $old_image; // Fallback to existing image
        }
    }

    // Update query
    $update_query = "UPDATE fornend_database_products 
                    SET category = ?, products = ?, price = ?, discount = ?, after_the_discount = ?, image = ? 
                    WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssddssi", $category, $products, $price, $discount, $after_discount, $image_path, $id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Product updated successfully');</script>";
        echo "<script>window.location.href = 'product.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating product');</script>";
    }

    $update_stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit-Product</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php include 'icon.php' ?>
    <!-- Favicon -->
    <link href="backend/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="backend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="backend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="backend/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="backend/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="home.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>
                        <?php
                            // Check if the session variable 'username' is set
                            if (isset($_SESSION['username'])) {
                                // Fetch username and profile image path from the database
                                $stmt = $conn->prepare("SELECT username, image FROM singin_database_name WHERE username = ?");
                                $stmt->bind_param("s", $_SESSION['username']);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    // Output username and image
                                    while ($row = $result->fetch_assoc()) {
                                        echo "  <span class='d-none d-lg-inline-flex'>" . htmlspecialchars($row["username"]) . "</span>";
                                    }
                                } else {
                                    echo "No user found";
                                }
                                $stmt->close();
                            } else {
                                echo "No session username found";
                            }
                        ?>
                    </h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <?php
                            // Check if the session variable 'username' is set
                            if (isset($_SESSION['username'])) {
                                // Fetch username and profile image path from the database
                                $stmt = $conn->prepare("SELECT username, image FROM singin_database_name WHERE username = ?");
                                $stmt->bind_param("s", $_SESSION['username']);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    // Output username and image
                                    while ($row = $result->fetch_assoc()) {
                                        // Display the image
                                        echo "<a href='myprofile.php'><img  class='rounded-circle me-lg-2 border border-2 border-white' src='" . htmlspecialchars($row['image']) . "' alt='' style='width: 50px; height: 50px; object-fit: cover;'></a>";
                                        echo "<div class='bg-success rounded-circle border border-2 border-white position-absolute end-1 bottom-0' style='width: 15px; height: 15px;'></div>";
                                    }
                                } else {
                                    echo "No user found";
                                }
                                $stmt->close();
                            } else {
                                echo "No session username found";
                            }
                        ?>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">
                            <?php
                                // Check if the session variable 'username' is set
                                if (isset($_SESSION['username'])) {
                                    // Fetch username and profile image path from the database
                                    $stmt = $conn->prepare("SELECT username, image FROM singin_database_name WHERE username = ?");
                                    $stmt->bind_param("s", $_SESSION['username']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        // Output username and image
                                        while ($row = $result->fetch_assoc()) {
                                            echo "  <span class='d-none d-lg-inline-flex'>" . htmlspecialchars($row["username"]) . "</span>";
                                        }
                                    } else {
                                        echo "No user found";
                                    }
                                    $stmt->close();
                                } else {
                                    echo "No username found";
                                }
                            ?>
                        </h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="home.php" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-bars me-2"></i>Menu Product</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="product.php" class="dropdown-item">Products</a>
                        </div>
                    </div>
                    <a href="productedit.php" class="nav-item nav-link active"><i class="fa fa-database me-2"></i>Edit Products</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.php" class="dropdown-item">Sign In</a>
                            <a href="sign_up.php" class="dropdown-item">Sign Up</a>
                            <a href="404.php" class="dropdown-item">404 Error</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="home.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Emails</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <?php
                                $email_sql = "SELECT mail FROM email";
                                $email_result = $conn->query($email_sql);

                                if ($email_result->num_rows > 0) {
                                    while ($email_row = $email_result->fetch_assoc()) {
                                        echo '<a href="#" class="dropdown-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2">
                                                        <h6 class="fw-normal mb-0">' . htmlspecialchars($email_row['mail']) . '</h6>
                                                    </div>
                                                </div>
                                              </a>
                                              <hr class="dropdown-divider">';
                                    }
                                } else {
                                    echo '<a href="#" class="dropdown-item text-center">No emails found</a>';
                                }
                            ?>
                            <a href="#" class="dropdown-item text-center">See all emails</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <?php
                                    // Check if the session variable 'username' is set
                                    if (isset($_SESSION['username'])) {
                                        // Fetch username and profile image path from the database
                                        $stmt = $conn->prepare("SELECT username, image FROM singin_database_name WHERE username = ?");
                                        $stmt->bind_param("s", $_SESSION['username']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            // Output username and image
                                            while ($row = $result->fetch_assoc()) {
                                                // Display the image
                                                echo "<img class='rounded-circle me-lg-2 border border-2 border-white' src='" . htmlspecialchars($row['image']) . "' alt='' style='width: 40px; height: 40px; object-fit: cover;'>";
                                                echo "  <span class='d-none d-lg-inline-flex'>" . htmlspecialchars($row["username"]) . "</span>";
                                            }
                                        } else {
                                            echo "No user found";
                                        }
                                        $stmt->close();
                                    } else {
                                        echo "No session username found";
                                    }
                                ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="myprofile.php" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="signin.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Edit Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Edit Product</h6>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $product['id']); ?>" method="POST" enctype="multipart/form-data"> 
                                <!-- Hidden ID Field -->
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

                                <!-- Hidden Field for Old Image Path -->
                                <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($product['image']); ?>">

                                <!-- Category Selection -->
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="categorySelect" name="category" required>
                                        <option value="" disabled>Select a category</option>
                                        <option value="laptops" <?php echo ($product['category'] === 'laptops') ? 'selected' : ''; ?>>Laptops</option>
                                        <option value="cameras" <?php echo ($product['category'] === 'cameras') ? 'selected' : ''; ?>>Cameras</option>
                                        <option value="smartphones" <?php echo ($product['category'] === 'smartphones') ? 'selected' : ''; ?>>smartphones</option>
                                        <option value="accessories" <?php echo ($product['category'] === 'accessories') ? 'selected' : ''; ?>>accessories</option>
                                    </select>
                                    <label for="categorySelect">Category</label>
                                </div>

                                <!-- Product Name -->
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="productName" name="products" placeholder="Enter Product Name" style="height: 115px;" required><?php echo htmlspecialchars($product['products']); ?></textarea>
                                    <label for="productName">Product Name</label>
                                </div>

                                <!-- Price -->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="priceInput" name="price" placeholder="Enter Price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                                    <label for="priceInput">Price ($)</label>
                                </div>

                                <!-- Discount -->
                                <div class="input-group mb-3">
                                    <input id="discountInput" class="form-control" placeholder="Discount %" name="discount" value="<?php echo htmlspecialchars($product['discount']); ?>" oninput="calculateDiscount()" required>
                                    <span class="input-group-text">=</span>
                                    <input type="text" id="afterDiscount" class="form-control" placeholder="After the discount" value="<?php echo htmlspecialchars($product['after_the_discount']); ?>" readonly>
                                </div>

                                <!-- File Input -->
                                <div class="mb-3">
                                    <input class="form-control" type="file" id="productImage" name="image" accept="image/*" onchange="previewImage(event)">
                                    <label for="productImage">Upload Product Image</label>
                                </div>

                                <!-- Image Preview -->
                                <div class="position-relative mt-2">
                                    <img id="imagePreview" src="<?php echo htmlspecialchars($product['image'] ?: 'default.jpg'); ?>" 
                                        alt="Image Preview" 
                                        class="img-thumbnail" 
                                        style="max-width: 200px; <?php echo ($product['image']) ? '' : 'display: none;'; ?>">
                                    <button id="clearButton" 
                                            type="button" 
                                            class="btn btn-danger d-none position-absolute top-0 end-0 p-2" 
                                            onclick="clearInput()">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary">Edit Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Admin</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="">Heng Audom</a>
                            <br>Distributed By: <a href="" target="_blank">Heng Audom</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript for Image Preview and Discount Calculation -->
    <script>
        function previewImage(event) {
            const output = document.getElementById('imagePreview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.style.display = 'block';
            document.getElementById('clearButton').style.display = 'block';
        }

        function calculateDiscount() {
            const price = parseFloat(document.getElementById('priceInput').value);
            const discount = parseFloat(document.getElementById('discountInput').value);
            const discountedPrice = price - (price * discount / 100);
            document.getElementById('afterDiscount').value = isNaN(discountedPrice) ? '' : discountedPrice.toFixed(2);
        }

        function clearInput() {
            document.getElementById('productImage').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('clearButton').style.display = 'none';
        }
    </script>
                
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
<?php
$conn->close();
?>
