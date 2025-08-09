<?php
function is_valid_username($username) {
    return preg_match("/^[a-zA-Z0-9._-]{2,}$/", $username);
}

function is_valid_password($password) {
    return strlen($password) >= 8 && preg_match("/[@#$%]/", $password);
}

// Registration Validation
if (isset($_POST['register'])) {
    $errors = [];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if (!is_valid_username($username)) {
        $errors[] = "Invalid username.";
    }

    if (!is_valid_password($password)) {
        $errors[] = "Password must be 8+ characters and include @, #, $, or %.";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    if (count($errors) > 0) {
        echo "<h3>Errors:</h3><ul><li>" . implode("</li><li>", $errors) . "</li></ul>";
    } else {
        header("Location: success.php");
        exit();
    }
}

// Login Validation
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!is_valid_username($username) || !is_valid_password($password)) {
        echo "Invalid login credentials.";
    } else {
        echo "Login successful.";
    }
}

?>