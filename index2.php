<?php
// Sample user database (usually stored in a database in a real application)
$users = array();

function register_user($email, $password)
{
    global $users;

    // Check if the email is already registered
    if (isset($users[$email])) {
        echo "Error: Email already registered.";
        return;
    }

    // Hash the password before storing it in the database
    $hashed_password = hash('sha256', $password);

    // Save user data in the database
    $users[$email] = array(
        'password' => $hashed_password,
        // Additional user information can be stored here (e.g., name, age, etc.)
    );

    echo "Registration successful!";
}

function login_user($email, $password)
{
    global $users;

    // Check if the email exists in the database
    if (!isset($users[$email])) {
        echo "Invalid email or password. Please try again.";
        return;
    }

    // Hash the provided password and compare it with the stored password
    $hashed_password = hash('sha256', $password);

    if ($users[$email]['password'] === $hashed_password) {
        echo "Login successful! Welcome to your dashboard.";
        // Here, you can redirect the user to their personalized dashboard
    } else {
        echo "Invalid email or password. Please try again.";
    }
}

// Sample usage for testing purposes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] === "register") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        register_user($email, $password);
    } elseif ($_POST["action"] === "login") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        login_user($email, $password);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>
</head>

<body>

    <h2>User Login</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="login">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>