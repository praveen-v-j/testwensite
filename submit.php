<?php
  if(!empty($_POST["send"])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $toEmail = $_POST["praveen3164@gmail.com"]

    $mailHeaders = "name: " . $name .
    "\r\n email: " . $email .
    "\r\n message: " . $message . "\r\n";

    if(mail($toEmail, $name, $mailHeaders)){
        $message = "Mail Send Successfully"
    }
  }
?>