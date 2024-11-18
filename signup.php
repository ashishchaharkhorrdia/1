<?php
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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required!";
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    } else {
        // Hash the password before storing it
       
        // Prepare SQL query to insert the data into the database
        $sql = "INSERT INTO signup (username, email, password) VALUES (?, ?, ?)";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            // Execute the query
            if ($stmt->execute()) {
                echo "Sign-up successful! You can now log in.";
            } else {
                echo "Error: " . $stmt->error;
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
    <title>Signup</title>
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
                <li><a href="sing up.html" class="sig">SignIn</a></li>
                
            </ul>
        </nav>
    </header>
<h2 style="text-align:center;">Create an Account</h2>

<!-- Sign-up form -->
 <!-- Form with Submit Button -->
 <form action="signup.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" class="submit-btn">Submit</button>
    </form>

    <script src="scripts.js"></script>
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
