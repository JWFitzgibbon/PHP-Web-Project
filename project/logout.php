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
$_SESSION = array();
session_destroy();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

</body>
</html>