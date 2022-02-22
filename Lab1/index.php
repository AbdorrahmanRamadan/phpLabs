<?php
require_once "config file.php";
$errorMessage = array();
$flag=0;
if(isset($_POST["submit"])){
    foreach($_POST as $field){
        if(empty($field)&&empty($errorMessage)){
            $errorMessage[] = "All fields are required";
        }
    }
    if(empty($errorMessage)){
        $flag=1;
    }
    if($flag==1){
    $name = $_POST["name"];
    if(isset($_POST['name'])){
        if(strlen($name)>NAME_MAX_LENGTH||strlen($name)<5){
            $errorMessage[] = "check length of name must be between 5 and 100" ;
        }
    }
    $email = $_POST["email"];
    if(isset($_POST['email'])){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errorMessage[] = "Email is not valid";
        }
    }
    $message = $_POST["message"];
    if(isset($_POST['message'])){
        if(strlen($message)>MESSAGE_MAX_LENGTH||strlen($message)<5){
            $errorMessage[] = "check length of message must be between 5 and 255";
    }   
}
    if(empty($errorMessage)){
        die("<center>Thanks for contacting US</center></br></br>
        <center>Name: $name</center></br>
        <center>Email: $email</center></br>
        <center>Message: $message</center></br>");
    } 
} 
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
            foreach($errorMessage as $line){
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