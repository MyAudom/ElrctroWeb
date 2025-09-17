<?php
include 'head.php';
// Fetch data from the database
$query = "SELECT id, image, price, category, products, discount FROM fornend_database_products";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Products</title>
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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-bars me-2"></i>Menu Product</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="product.php" class="dropdown-item active">Products</a>
                        </div>
                    </div>
                    <a href="add.php" class="nav-item nav-link"><i class="fa fa-database me-2"></i>Add Products</a>
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
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Button Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h4 class="mb-4">Products Labtop</h4>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-white text-center">
                                            <th scope="col">ID</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Gatagory</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">After Discount</th>
                                            <th scope="col">Dettal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            // Query to fetch products
                                            $query = "SELECT id, image, price, category, products, discount FROM fornend_database_products";
                                            $result = $conn->query($query);

                                            if ($result && $result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $id = htmlspecialchars($row['id']);
                                                    $image_path = htmlspecialchars($row['image']);
                                                    $price = $row['price'];
                                                    $discount = $row['discount'];
                                                    $after_discount = $price - ($price * $discount / 100);

                                                    echo "<tr>";
                                                    echo "<td>$id</td>";

                                                    // Display image or placeholder
                                                    if (!empty($image_path) && file_exists($_SERVER['DOCUMENT_ROOT'] . "image_upload/" . basename($image_path))) {
                                                        echo "<td><img src='image_upload/'" . basename($image_path) . "' alt='Product Image' style='width: 100px; height: auto;'></td>";
                                                    } else {
                                                        echo "<td>Image not found</td>";
                                                    }

                                                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['products']) . "</td>";
                                                    echo "<td>" . number_format($price, 2) . " USD</td>";
                                                    echo "<td>" . htmlspecialchars($discount) . "%</td>";
                                                    echo "<td>" . number_format($after_discount, 2) . " USD</td>";
                                                    echo "<td>
                                                            <form method='POST' style='display:inline;'>
                                                                <input type='hidden' name='id' value='$id'>
                                                                <button type='submit' class='btn btn-danger'>Delete</button>
                                                            </form>
                                                        <form method='GET' action='productedit.php' style='display:inline;'>
                                                            <input type='hidden' name='id' value='$id'>
                                                            <button type='submit' class='btn btn-primary'>Edit</button>
                                                        </form>
                                                        </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6' class='text-center'>No data available</td></tr>";
                                            }

                                            // Handle deletion of product
                                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                                                $id = intval($_POST['id']); // Ensure ID is valid

                                                // Fetch image path for deletion
                                                $image_sql = "SELECT image FROM fornend_database_products WHERE id = ?";
                                                $image_stmt = $conn->prepare($image_sql);
                                                if ($image_stmt) {
                                                    $image_stmt->bind_param("i", $id);
                                                    if ($image_stmt->execute()) {
                                                        $image_result = $image_stmt->get_result();
                                                        if ($image_result->num_rows > 0) {
                                                            $image_row = $image_result->fetch_assoc();
                                                            $image_path = $image_row['image'];
                                                            $image_full_path = $_SERVER['DOCUMENT_ROOT'] . "image_upload/" . basename($image_path);

                                                            // Delete image file if exists
                                                            if (!empty($image_path) && file_exists($image_full_path)) {
                                                                unlink($image_full_path);
                                                            }
                                                        }
                                                    }
                                                    $image_stmt->close();
                                                }

                                                // Delete product record from database
                                                $delete_sql = "DELETE FROM fornend_database_products WHERE id = ?";
                                                $delete_stmt = $conn->prepare($delete_sql);
                                                if ($delete_stmt) {
                                                    $delete_stmt->bind_param("i", $id);
                                                    if ($delete_stmt->execute()) {
                                                        echo "<script>alert('Product deleted successfully');</script>";
                                                    } else {
                                                        echo "<script>alert('Error deleting product');</script>";
                                                    }
                                                    $delete_stmt->close();
                                                }

                                                // Redirect to prevent form resubmission
                                                echo "<script>window.location.href = 'product.php';</script>";
                                                exit();
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php $conn->close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button End -->


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