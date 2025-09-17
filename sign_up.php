<?php
include 'head.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $image = null;

    // Additional sanitization (optional but recommended)
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>Invalid email format.</div>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if fields are empty
        if (empty($username) || empty($email) || empty($password)) {
            echo "<div class='alert alert-danger'>All fields are required.</div>";
        } else {
            // Handle file upload for profile picture
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "image_upload/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
                // Check if the file is an image
                if (getimagesize($_FILES["image"]["tmp_name"]) !== false) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $image = $target_file; // Store the image path
                    } else {
                        echo "<div class='alert alert-danger'>Error uploading the file.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Only image files are allowed.</div>";
                }
            }

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO singin_database_name (username, email, password, image) VALUES (?, ?, ?, ?)");

            if ($stmt) {
                // Bind parameters
                $stmt->bind_param("ssss", $username, $email, $hashed_password, $image);

                // Execute the statement and check for errors
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>New account created successfully!</div>";
                    header("Location: signin.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "<div class='alert alert-danger'>Failed to prepare statement: " . $conn->error . "</div>";
            }
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Signup Account</title>
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


        <!-- Sign Up Form -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin Account</h3>
                            </a>
                            <h3>Sign Up</h3>
                        </div>

                        <!-- Sign Up Form -->
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3" style="position: relative; display: flex; justify-content: center; width: 150px; height: 150px; margin-left: 130px;">
                                <!-- Profile Picture -->
                                <img id="profilePicture" class="rounded-circle border border-5 border-primary" 
                                    src="img/testimonial-2.jpg" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                                <!-- Edit Button -->
                                <a href="#" class="btn btn-primary" style="position: absolute; bottom: 10px; right: 0px; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;" onclick="document.getElementById('imageInput').click();">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <input type="file" id="imageInput" name="image" style="display: none;" accept="image/*" onchange="handleFileChange(event)">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="username" id="floatingText" placeholder="Username" required>
                                <label for="floatingText">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                                <!-- Eye Icon -->
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword()">
                                    <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                            <p class="text-center mb-0">I have an Account? <a href="signin.php">Sign In</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update the image source to the selected file
                    document.getElementById('profilePicture').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function togglePassword() {
            const passwordField = document.getElementById('floatingPassword');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
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