<?php
require_once "config file.php";
$errorMessages = array();
$flag=0;
$login_succeded=false;
$vars = [
    'name' => '',
    'email' => '',
    'message' => ''
];
session_start();
if (!isset($_SESSION["is_visited"])) {
    echo "First Visit, Hello!";
    $_SESSION["is_visited"] = true;
} else {
    $_SESSION["counter"] = isset($_SESSION["counter"]) ? $_SESSION["counter"] + 1 : 2;
    echo "you visited this page " . $_SESSION["counter"] . " times";
}

if(isset($_POST["submit"])){
    $vars['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $vars['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $vars['message'] =  filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    
    if (isset($vars['name']) && strlen($vars['name']) != 0) {
        if (strlen($vars['name']) > MAX_NAME_LENGTH) {
            $errorMessages[] = "Name is too long, must be less than 100 characters";
        }
    } else {
        $errorMessages[] = 'Name is required';
    }
    if (isset($vars['message']) && strlen($vars['message']) != 0) {
        if (strlen($vars['message']) > MAX_MESSAGE_LENGTH) {
            $errorMessages[] = "Message is too long, must be less than 255 characters";
        }
    } else {
        $errorMessages[] = 'Message is required';
    }
    if (isset($vars['email']) && strlen($vars['email']) != 0) {
        if (!filter_var($vars['email'], FILTER_VALIDATE_EMAIL)) {
            $errorMessages[] = "Please enter a valid email";
        }
    } else {
        $errorMessages[] = 'Email is required';
    }
    $login_succeded = count($errorMessages) === 0;
}
    if($login_succeded){
        $date = date("F d Y h:m A");
        $ip = $_SERVER['REMOTE_ADDR'];
        $record = "$date,$ip,${vars['name']},${vars['email']}\n";
        $filePointer = fopen("login.txt","a+");
        fwrite($filePointer, $record);
        fclose($filePointer);
        die("<center>Thanks for contacting US</center></br></br>
        <center>Name: ".$vars['name']."</center></br>
        <center>Email: ". $vars['email'] ."</center></br>
        <center>Message: ".$vars['message']."</center></br>");
    } 
function get_default($field){
    if(isset($_POST[$field])){
        echo $_POST[$field];
    }else{
        echo "";
    }
}
?>
<html>

    <head>
        <title> contact form </title>


    </head>

    <body>
        
        <h3> Contact Form </h3>
        <div id="after_submit">
        <?php  
            foreach($errorMessages as $line){
                echo "** $line <br/>";
            }
        ?>
        </div>
        
        <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="required" for="name">Your name:</label><br />
                <input id="name" class="input" name="name" type="text" value="<?php get_default('name'); ?>" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="email">Your email:</label><br />
                <input id="email" class="input" name="email" type="text" value="<?php get_default('email'); ?>" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="message">Your message:</label><br />
                <textarea id="message" class="input" name="message" rows="7" cols="30"><?php get_default('message'); ?></textarea><br />

            </div>

            <input id="submit" name="submit" type="submit" value="Send email" />
            <input id="clear" name="clear" type="reset" value="clear form" />

        </form>
    </body>

</html>