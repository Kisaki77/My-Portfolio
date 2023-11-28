<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["contactName"];
    $email = $_POST["contactEmail"];
    $subject = $_POST["contactSubject"];
    $message = $_POST["contactMessage"];

    $to = "nobuhlemlahleki@gmail.com";
    $headers = "From: $email";

    mail($to, $subject, $message, $headers);
}
?>

