<?php
include 'head.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $categoryId = $_POST['category'];
    $productName = $_POST['products'];
    $price = $_POST['price'];
    $discountPercentage = $_POST['discount'];
    $afterDiscount = str_replace('$ ', '', $_POST['after_the_discount']);

    // Handle the image upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $imageName = $_FILES['product_image']['name'];
        $imageTmpName = $_FILES['product_image']['tmp_name'];
        $imageSize = $_FILES['product_image']['size'];
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

        // Validate file extension
        if (in_array(strtolower($imageExt), $allowedExts)) {
            // Generate a unique filename to avoid overwriting
            $imageNewName = uniqid('', true) . '.' . $imageExt;
            $imageDestination = 'image_upload/' . $imageNewName;

            // Move the uploaded image to the "image_upload" folder
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                // Insert product data into the database
                $stmt = $conn->prepare("INSERT INTO fornend_database_products (category, products, price, discount, after_the_discount, image) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $categoryId, $productName, $price, $discountPercentage, $afterDiscount, $imageDestination);

                // Execute the query
                if ($stmt->execute()) {
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error uploading the image.";
            }
        } else {
            echo "Invalid image type. Only JPG, JPEG, PNG, GIF are allowed.";
        }
    } else {
        echo "No image uploaded or error occurred.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add product</title>
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
                                        // Display the image
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
                                            // Display the image
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
                    <a href="add.php" class="nav-item nav-link active"><i class="fa fa-database me-2"></i>Add Products</a>
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


            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add Products</h6>
                            <form action="add.php" method="POST" enctype="multipart/form-data">
                                <!-- Select Category -->
                                <select class="form-select" id="floatingSelect" name="category" aria-label="Floating label select example">
                                    <option selected>Select menu category</option>
                                    <option value="laptops">Labtops</option>
                                    <option value="cameras">Cameras</option>
                                    <option value="smartphones">Smartphones</option>
                                    <option value="accessories">Accessories</option>
                                </select>

                                <!-- Product Name -->
                                <div class="form-floating mt-2">
                                    <textarea class="form-control" placeholder="Product Name" id="floatingTextarea" name="products" style="height: 115px;"></textarea>
                                    <label for="floatingTextarea">Product Name</label>
                                </div>

                                <!-- Price -->
                                <div class="form-floating mb-3 mt-2">
                                    <input class="form-control" id="floatingPrice" placeholder="Enter price" name="price">
                                    <label for="floatingPrice">$ Price</label>
                                </div>

                                <!-- Discount Calculation -->
                                <div class="input-group mb-3">
                                    <input id="discountPercentage" class="form-control" placeholder="Discount %" aria-label="Discount" name="discount">
                                    <span class="input-group-text">=</span>
                                    <input type="text" id="afterDiscount" class="form-control" placeholder="After the discount" aria-label="After Discount" readonly name="after_the_discount">
                                </div>

                                <!-- File Input -->
                                <div class="mb-3 d-flex align-items-center gap-2 mt-2">
                                    <input class="form-control bg-dark" type="file" id="formFile" name="product_image" accept="image/*" onchange="previewImage(event)">
                                </div>

                                <!-- Image Preview Container -->
                                <div class="position-relative d-inline-block mt-2">
                                    <img id="imagePreview" src="" alt="Image Preview" class="img-thumbnail d-none" style="max-width: 200px; max-height: 200px;">
                                    <button id="clearButton" type="button" class="btn btn-danger d-none position-absolute top-0 end-0 p-2" onclick="clearInput()" style="color:red; background: none; border: none;">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>

                                <!-- Add Product Button -->
                                <div class="d-grid mt-4">
                                    <button class="btn btn-primary" type="submit">Add Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->


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
        <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->
    </div>

    <!-- add image clear -->
    <script>
        // Preview image on file input change
        function previewImage(event) {
            var output = document.getElementById('imagePreview');
            output.classList.remove('d-none');
            output.src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('clearButton').classList.remove('d-none');
        }

        // Clear the image input
        function clearInput() {
            document.getElementById('formFile').value = '';
            document.getElementById('imagePreview').classList.add('d-none');
            document.getElementById('clearButton').classList.add('d-none');
        }

        // Discount calculation
        document.getElementById('discountPercentage').addEventListener('input', function() {
            var price = parseFloat(document.getElementById('floatingPrice').value);
            var discount = parseFloat(this.value);
            var discountedPrice = price - (price * discount / 100);
            document.getElementById('afterDiscount').value = isNaN(discountedPrice) ? '' : discountedPrice.toFixed(2);
        });
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

</html><?php
$conn->close();
?>
</html>
