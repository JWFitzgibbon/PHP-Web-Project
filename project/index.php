<?php
ini_set("session.save_path", "/home/unn_w18014737/sessionData");
session_start();
require_once ("functions.php");

login_validation();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>

    <h1>Home Page</h1>

    <aside id="offers"></aside>
    <br>
    <aside id="XMLoffers"></aside>

    <h2>Navigation</h2>
        <ul>
            <li><a href="adminPage.php">Admin</a></li>
            <li><a href="bookEventsForm.php">Book events</a></li>
        </ul>

<script src="ajaxScripts.js"></script>
</body>
</html>