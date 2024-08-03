<?php
session_start();

// Set the maximum number of login attempts
$maxLoginAttempts = 3;

// Set the lockout duration in seconds (e.g., 5 minutes)
$lockoutDuration = 5;

// Check if the login attempts session variable is set
if (!isset($_SESSION["loginAttempts"])) {
    $_SESSION["loginAttempts"] = 0;
}

// Check if the user has exceeded the maximum number of login attempts and is currently in lockout
if ($_SESSION["loginAttempts"] >= $maxLoginAttempts && isset($_SESSION["lockoutTime"])) {
    $timeSinceLockout = time() - $_SESSION["lockoutTime"];

    // If the lockout duration has passed, reset login attempts and remove lockout time
    if ($timeSinceLockout >= $lockoutDuration) {
        $_SESSION["loginAttempts"] = 0;
        unset($_SESSION["lockoutTime"]);
    } else {
        $remainingTime = $lockoutDuration - $timeSinceLockout;
        $minutesRemaining = ceil($remainingTime );
        $message = "Too many login attempts. Your account is locked for " . $minutesRemaining . " minutes.";

        /*echo "Too many login attempts. Your account is blocked. Please try again later.";
       */ 
      echo '<div class="alert alert-danger" role="alert">';
    echo $message;
    echo '</div>';
       exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "hotel_reservation";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $adminUsername = $_POST["adminUsername"];
    $adminPassword = $_POST["adminPassword"];

    // Validate user credentials (You should use password hashing in a real scenario)
    $query = "SELECT * FROM admin_users WHERE username='$adminUsername' AND password='$adminPassword'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Authentication successful
        $_SESSION["adminLoggedIn"] = true;
        $_SESSION["loginAttempts"] = 0; // Reset login attempts on successful login
        unset($_SESSION["lockoutTime"]); // Remove lockout time
        header("Location: admin.html"); // Redirect to admin dashboard or any other admin page
        exit();
    }else{
        
        // Increment the login attempts
        $_SESSION["loginAttempts"]++;
        
        // Check if the maximum login attempts are reached
        if ($_SESSION["loginAttempts"] >= $maxLoginAttempts) {
            $_SESSION["lockoutTime"] = time(); // Set lockout time
            echo "Your account is blocked. Please try again later.";
            exit();
        }
    }
    

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f4f4f4;
}

.admin-login-container {
    text-align: center;
    border: 1px solid #ddd;
    background-color: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
}

h2 {
    color: #333;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #555;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}


 .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    .alert-danger {
      background-color: #f2dede;
      border-color: #e4b9b9;
      color: #a94442;
    }
    
    

    </style>
</head>
<body>
    <div class="admin-login-container">
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="post">
            <label for="adminUsername">Username:</label>
            <input type="text" id="adminUsername" name="adminUsername" autocomplete="off" required>

            <label for="adminPassword">Password:</label>
            <input type="password" id="adminPassword" name="adminPassword" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
