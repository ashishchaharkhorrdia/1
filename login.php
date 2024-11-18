<?php
session_start(); // Start a session to store user info

// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "ashishchahar"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Get form data
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Validate form data
    if (empty($input_username) || empty($input_password)) {
        echo "Both fields are required!";
        
    } else {
        // Prepare SQL query to fetch user data
        $sql = "SELECT  username, password FROM signup WHERE username = ?";

        // Prepare statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("s", $input_username);

            // Execute query
            $stmt->execute();

            // Store result
            $stmt->store_result();
            $hashed_password=password_hash($password,PASSWORD_BCRYPT);
            // Check if the user exists
            if ($stmt->num_rows > 0) {
                // Bind the result to variables
                $stmt->bind_result( $username, $hashed_password);

                // Fetch the data
                $stmt->fetch();

                // Verify the password
                if (password_verify($input_password, $hashed_password)) {
                    // Password is correct, create a session
                    $_SESSION['loggedin'] = true;
                    // $_SESSION['userid'] = $id;
                    $_SESSION['username'] = $username;

                    // Redirect to a protected page (e.g., dashboard)
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "Invalid password!";
                }
            } else {
                echo "No user found with that username!";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<header>
        <nav>
            <ul>
                <li><input type="search" placeholder="Search" class="search" ></li>
                <li><a href="Index.html">Home</a></li>
                <li><a href="Cource.html">Cource</a></li>
                <!-- <li><a href="#">About</a></li>-->
                <li><a href="login.php">Log In</a></li> 
                <li><a href="signup.php" class="sig">SignIn</a></li>
                
            </ul>
        </nav>
    </header>
<h2 style="text-align:center;">Login to Your Account</h2>

<!-- Login form -->
<form action="login.php" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit" name="submit">Login</button>
</form>
<footer>
        <p>&copy; 2024 Responsive Website</p>
        <div class="footer-content">
            <!-- Logo -->
            <img src="/img/study.jpg" alt="Your Logo" class="footer-logo">

            <p>© 2024 [Your Name] | All Rights Reserved</p>
            <p>Built with ❤️ using HTML, CSS, and JavaScript</p>
            <div class="social-links">
                <a href="https://github.com/yourusername">GitHub</a>
                <a href="https://linkedin.com/in/yourusername">LinkedIn</a>
                <a href="mailto:your.email@example.com">Email</a>
                <a href="/privacy-policy">Privacy Policy</a>
            </div>
            <p class="footer-note">This website was created to showcase my projects, skills, and experiences as a developer.</p>
        </div>
    </footer>
</body>
</html>
