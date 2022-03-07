<?php
session_start();
require_once("vendor/autoload.php");
$counter = 0;
if (Login::check_login()) {
    $page = "counter";
}
elseif(isset($_POST['username'])&&isset($_POST['password'])) {
    if (Login::authenticate($_POST["username"],$_POST["password"])){
        Counter::increment();
        $counter = Counter::getCount();
        $file_controller = fopen('counter.txt', 'w+');
        $line = "$counter";
        fwrite($file_controller, $line);
        $page = "counter";
    } 
}
else {
    $page = "login";
}
require_once("Views/$page.php");
?>