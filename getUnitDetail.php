<?php

require "database.php";
require "authentication.php";
quitIfNotAdmin();

$conn = database();

$result = $conn->query("
SELECT U_ID, F_NAME, L_NAME FROM USER WHERE SUBSTRING(ROOM,1,2) = '{$_GET['unit']}' OR SUBSTRING(ROOM,1,4) = '{$_GET['unit']}'
");

while ($roommate = $result->fetch_assoc()){
    echo($roommate['U_ID']);
    echo($roommate['F_NAME']);
    echo($roommate['L_NAME']);
    echo("<br>");
    $forms = $conn->query("
    SELECT FORM_FILLED.FILLED_FORM_ID FROM FORM_FILLED INNER JOIN FORM_USER ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID WHERE FORM_USER.U_ID = {$roommate['U_ID']}
    ");
    while ($form = $forms->fetch_assoc()){
        echo("<a href='forms/formDetail.php?filled={$form['FILLED_FORM_ID']}'>Filled Form {$form['FILLED_FORM_ID']}</a><br>");
    }
    echo("<br>");
}

echo("end of query for unit {$_GET['unit']}");