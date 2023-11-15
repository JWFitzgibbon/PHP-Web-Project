<?php
function getConnection() {
    try {
        $connection = new PDO("mysql:host=localhost;dbname=unn_w18014737",
            "unn_w18014737", "yoloswag");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        throw new Exception("Connection error ". $e->getMessage(), 0, $e);
    }
}

function login_validation() {
    if (isset($_SESSION['logged-in']) and $_SESSION['logged-in'] = true) {
        echo "<a href='logout.php'>Log out</a>";
        return true;
    }
    else {
        echo '<form method="post" action="loginProcess.php">
                Username <input type="text" name="username">
                Password <input type="password" name="password">
              <input type="submit" value="Logon">
</form>';
        return false;
    }
}
