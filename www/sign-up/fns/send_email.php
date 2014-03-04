<?php

function send_email ($username, $email) {

    $escapedUsername = htmlspecialchars($username);
    $html =
        '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$escapedUsername Signed Up</title>"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
            .'</head>'
            .'<body>'
                ."<b>$escapedUsername</b> has signed up with the email"
                .' <b>'.htmlspecialchars($email).'</b>.'
            .'</body>'
        .'</html>';

    $subject = mb_encode_mimeheader("$username Signed Up", 'UTF-8');

    $headers =
        "From: no-reply@zvini.com\r\n"
        .'Content-Type: text/html; charset=UTF-8';

    mail('info@zvini.com', $subject, $html, $headers);

}
