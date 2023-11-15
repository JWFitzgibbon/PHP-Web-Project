<?php
ini_set("session.save_path", "/home/unn_w18014737/sessionData");
session_start();
require_once ("functions.php");

login_validation();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Book events</title>
</head>
<body>

<?php

$url = "http://unn-izge1.newnumyspace.co.uk/KF5002/assessment/bookEventsFormInc.php";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
echo $result;
?>

<script src="formProcess.js"></script>

</body>
</html>