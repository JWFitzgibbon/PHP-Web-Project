<?php
ini_set("session.save_path", "/home/unn_w18014737/sessionData");
session_start();
require_once ("functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
</head>
<body>

    <?php
    if (login_validation()) {

        try {
            $dbConn = getConnection();

            $sqlQuery = "SELECT eventID, eventTitle, catDesc, venueName, location, eventStartDate, eventEndDate, eventPrice
                         FROM NE_events
                         INNER JOIN NE_venue
                         ON NE_venue.venueID = NE_events.venueID
                         INNER JOIN NE_category
                         ON NE_category.catID = NE_events.catID
                         ORDER BY eventTitle";
            $queryResult = $dbConn->query($sqlQuery);

            while ($rowObj = $queryResult->fetchObject()) {
                echo "<div class='event'>\n
                        <span class='eventTitle'><a href='adminEventEdit.php?eventID={$rowObj->eventID}'>{$rowObj->eventTitle}</a></span>\n
                        <span class='catDesc'>{$rowObj->catDesc}</span>\n
                        <span class='venueName'>{$rowObj->venueName}</span>\n
                        <span class='location'>{$rowObj->location}</span>\n
                        <span class='eventStartDate'>{$rowObj->eventStartDate}</span>\n
                        <span class='eventEndDate'>{$rowObj->eventEndDate}</span>\n
                        <span class='eventPrice'>£{$rowObj->eventPrice}</span>\n
                      </div>\n";
            }

        } catch (Exception $e) {
            echo "<p>Query error: " . $e->getMessage() . "</p>\n";
        }
    }
    else {
        echo "<p>You need to be logged in to access this page</p>\n";
    }

    ?>

</body>
</html>