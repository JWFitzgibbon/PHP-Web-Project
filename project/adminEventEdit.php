<?php
ini_set("session.save_path", "/home/unn_w18014737/sessionData");
session_start();
require_once ("functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Edit</title>
</head>
<body>

    <?php
    if (login_validation()) {

        $eventID = filter_has_var(INPUT_GET, 'eventID') ? $_GET['eventID'] : null;

        if (empty($eventID)) {
            echo "<p>Invalid ID chosen to edit, try again: <a href='adminPage.php'>Back to admin page</a> </p>";
        }

        try {

            $dbConn = getConnection();


            $sqlQuery = "SELECT eventID, eventTitle, catDesc, eventDescription, venueName, eventStartDate, eventEndDate, eventPrice
                         FROM NE_events
                         INNER JOIN NE_venue
                         ON NE_venue.venueID = NE_events.venueID
                         INNER JOIN NE_category
                         ON NE_category.catID = NE_events.catID
                         WHERE eventID = $eventID";
            $queryResult = $dbConn->query($sqlQuery);

            $rowObj = $queryResult->fetchObject();


            echo "<form id='UpdateEvent' action='updateEvent.php' method='get'>
                    <p>Title: <input type='text' name='eventTitle' value='{$rowObj->eventTitle}'></p>\n
                    <p>Description: <input type='text' name='eventDescription' value='{$rowObj->eventDescription}'></p>\n
                    <p>Start date: <input type='text' name='eventStartDate' value='{$rowObj->eventStartDate}'></p>\n
                    <p>End date: <input type='text' name='eventEndDate' value='{$rowObj->eventEndDate}'></p>\n
                    <p>Price: <input type='text' name='eventPrice' value='{$rowObj->eventPrice}'></p>\n
                    <input type='hidden' name='eventID' value='$eventID'>
                    <input type='submit'>
                  </form>"; // Venue: <input type='text' name='venueName' value='{$rowObj->venueName}'>\n make venue and catDesc a drop down list


        } catch (Exception $e) {
            echo "<p>Query error: " . $e->getMessage() . "</p>\n";
        }
    }

    else {
        echo "<p>You need to be logged in to access this page: <a href='loginForm.html'>Log in</a></p>\n";
    }
    ?>

</body>
</html>