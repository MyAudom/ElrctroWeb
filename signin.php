<?php
include 'head.php';

// Initialize the error message variable
$error_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format. Please enter a valid email address.";
    } 
    // Validate password
    elseif (empty($password)) {
        $error_message = "Password cannot be empty. Please enter your password.";
    } else {
        // Proceed with SQL only if there are no validation errors
        $stmt = $conn->prepare("SELECT id, username, password FROM singin_database_name WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email); // Bind email as parameter

            // Execute the statement
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a user exists with that email
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc(); // Fetch user data
                
                // Check if password is correct using password_verify()
                if (password_verify($password, $user['password'])) {
                    // Start session and redirect to user dashboard or home page
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    header("Location: home.php"); // Redirect to dashboard or home
                    exit();
                } else {
                    // Password is incorrect
                    $error_message = "Invalid password. Please try again.";
                }
            } else {
                // No user found with the given email
                $error_message = "No account found with that email.";
            }

            // Close the statement
            $stmt->close();
        } else {
            // Error in preparing the query
            $error_message = "Failed to prepare statement: " . $conn->error;
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
    <title>Signin Account</title>
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
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm- 5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.php" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin Account</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        <form action="signin.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                                <!-- Eye Icon -->
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword()">
                                    <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
