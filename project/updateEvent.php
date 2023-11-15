<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

    <?php

        $eventID = filter_has_var(INPUT_GET, 'eventID') ? $_GET['eventID'] : null;
        $eventTitle = filter_has_var(INPUT_GET, 'eventTitle') ? $_GET['eventTitle'] : null;
        $eventDescription = filter_has_var(INPUT_GET, 'eventDescription') ? $_GET['eventDescription'] : null;
        $catDesc = filter_has_var(INPUT_GET, 'catDesc') ? $_GET['catDesc'] : null;
        $eventStartDate = filter_has_var(INPUT_GET, 'eventStartDate') ? $_GET['eventStartDate'] : null;
        $eventEndDate = filter_has_var(INPUT_GET, 'eventEndDate') ? $_GET['eventEndDate'] : null;
        $eventPrice = filter_has_var(INPUT_GET, 'eventPrice') ? $_GET['eventPrice'] : null;

        $eventTitle = filter_var($eventTitle, FILTER_SANITIZE_STRING);
        $eventDescription = filter_var($eventDescription, FILTER_SANITIZE_STRING);
        $eventStartDate = filter_var($eventStartDate, FILTER_SANITIZE_NUMBER_FLOAT);
        $eventEndDate = filter_var($eventEndDate, FILTER_SANITIZE_NUMBER_FLOAT);
        $eventPrice = filter_var($eventPrice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);


        $validationError = false;

        if (empty($eventTitle or $eventDescription or $eventStartDate or $eventEndDate or $eventPrice)) {
            echo "<p>Field(s) empty, please try again.</p>";
            $validationError = true;
        }
        if ($validationError) {
            echo "<p>There are errors, please try again: <a href='adminEventEdit.php'>Back to edit</a></p>";
        }
        else {
            try {
                require_once("functions.php");
                $dbConn = getConnection();

                $updateSQL = "UPDATE NE_events
                          SET eventTitle = :eventTitle, eventDescription = :eventDescription,
                           eventStartDate = :eventStartDate, eventEndDate = :eventEndDate, eventPrice = :eventPrice
                          WHERE eventID = :eventID";

                $stmt = $dbConn->prepare($updateSQL);
                $stmt->execute(array(':eventTitle' => $eventTitle, ':eventDescription' => $eventDescription,
                    ':eventStartDate' => $eventStartDate, ':eventEndDate' => $eventEndDate,
                    ':eventPrice' => $eventPrice, ':eventID' => $eventID));

                echo "<p>Event edited successfully</p>\n";

            } catch (Exception $e) {
                echo "<p>Edit error: " . $e->getMessage() . "</p>\n";
            }
        }

    ?>

</body>
</html>