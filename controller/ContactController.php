<?php

//include_once '../Navigation_Links.php';
global $frontend_routes;
require '../routes.php';
require '../utils/system_functions.php';


require_once __DIR__ . '/../model/CommunicationRepo.php';


session_start();


$Login_page = $frontend_routes['login'];
$Game_Page = $frontend_routes['game'];
$contact_form = $frontend_routes['contact_us'];

//echo $_SERVER['REQUEST_METHOD'];
$everythingOKCounter = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "Got Req";

//* Email Validation
    $message = $_POST['message'];
    if (empty($message)) {

        $everythingOK = FALSE;
        $everythingOKCounter += 1;

        echo '<br>No Message Found Error 1<br>';
    } else {
        $everythingOK = TRUE;
    }

    if ($everythingOK && $everythingOKCounter === 0) {


        echo '<br>Everything is OK<br>';
        echo '<br>Message Found is : <br>'.$message;

//        Send Message to Database

        $decision = updateMessage($message,1);
        if($decision){
            navigate($Login_page);
        }else{
            navigate($contact_form);
        }

//        echo '<br><br>';
        echo '<br>Everything is ok<br>';
    } else {
        echo '<br>Returning to Contact Form page because The data user provided is not properly validated like message must be provided <br>';
//        header("Location: {$contact_form}");
        navigate($contact_form);
        exit;
    }






}


