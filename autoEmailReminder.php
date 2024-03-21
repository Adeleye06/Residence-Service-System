<?php
require "database.php";
require "email.php";

//get the all reminders
$conn = database();
$allReminder = $conn -> query("SELECT * FROM EMAIL_TYPE WHERE REMINDER_DATE IS NOT NULL AND ENABLED IS TRUE");

if ($allReminder -> num_rows == 0){
    die("no reminders set up, skip this auto email");
}

while ($reminder = $allReminder -> fetch_assoc()){
    $FORM_ID = $reminder['FORM_ID'];
    $EMAIL_TYPE_ID = $reminder['EMAIL_TYPE_ID'];
    $REMINDER_DATE = new DateTime($reminder['REMINDER_DATE']);
    //$DUE_DATE = date_create($conn -> query("SELECT DUE_DATE FROM FORM_TYPE WHERE FORM_ID = $FORM_ID") -> fetch_assoc()['DUE_DATE']);
    $today = new DateTime("now");

    if ($REMINDER_DATE > $today){
        echo "this reminder is not at the time! no need to send reminder now!";
        continue;
    }

    $FORM_NAME = $conn -> query("SELECT FORM_NAME FROM FORM_TYPE WHERE FORM_ID = $FORM_ID") -> fetch_assoc()['FORM_NAME'];

    $sql = "
        SELECT U_ID FROM USER AS U WHERE NOT EXISTS(-- gets everyone who filled the form
            SELECT * FROM 
            FORM_USER JOIN USER ON FORM_USER.U_ID = USER.U_ID JOIN FORM_FILLED ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID
            WHERE FORM_ID = $FORM_ID AND U.U_ID = USER.U_ID
        )
        AND ROOM IS NOT NULL -- anyone assigned to a room is a resident and should recieve the email reminder, even some admin like ra can recieve
    ";

    //if this user allows roommate to fill, then filter out kodiak house people since they are not likely need to fill it
//    if ($conn -> query("SELECT * FROM FORM_TYPE WHERE FORM_ID = $FORM_ID AND NOT MAX_USER_PER_FORM = 1") -> num_rows != 0){
//        $sql = $sql . "AND ROOM NOT LIKE '____'";
//    }

    $UNFILLED = $conn -> query($sql);

    while ($i = $UNFILLED -> fetch_assoc()['U_ID']){
        sendEmailtoUID($i, $EMAIL_TYPE_ID, "");
        echo "sending emails to $i!!!";
    }

}