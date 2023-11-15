<?php
ini_set("session.save_path", "/home/unn_w18014737/sessionData");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
$username = filter_has_var(INPUT_POST, 'username')
? $_POST['username']: null;
$password = filter_has_var(INPUT_POST, 'password')
? $_POST['password']: null;

try {
    require_once("functions.php");
    $dbConn = getConnection();

    $querySQL = "SELECT passwordHash from NE_users
                 WHERE username = :username";

    $stmt = $dbConn->prepare($querySQL);

    $stmt->execute(array(':username' => $username));

    $user = $stmt->fetchObject();
    if ($user) {
        if (password_verify($password, $user->passwordHash)) {
            $_SESSION['logged-in'] = true;
            $_SESSION['username'] = $username;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else {
            echo "<p>Username or password was incorrect, try again: <a href='loginForm.html'>Login form</a></p>";
        }
    } else {
        echo "<p>Username or password was incorrect, try again: <a href='loginForm.html'>Login form</a></p>";
    }
}
catch (Exception $e) {
    echo "There was a problem: " . $e->getMessage();
}
?>

</body>
</html>
