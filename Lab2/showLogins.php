<?php

$imported_user_data = file("login.txt");
$data = array("Date", "IP", "Name", "Email");

foreach ($imported_user_data as $key => $value) {
    echo "<center>user $key </center></br>";
    $keys_values = explode(",", $value);
    foreach ($keys_values as $field => $value_from_text_file) {
        echo "<center> " . $data[$field] . ": " . $value_from_text_file . " </br> </center>";
    }
    echo "</br> <hr /> </br>";
}
?>
