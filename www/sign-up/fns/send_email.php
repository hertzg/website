<?php

function send_email ($username) {

    include_once __DIR__.'/../../fns/get_domain_name.php';
    $domain_name = get_domain_name();

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
                ."<b>$escapedUsername</b> has signed up."
            .'</body>'
        .'</html>';

    $subject = mb_encode_mimeheader("$username Signed Up", 'UTF-8');

    $headers =
        "From: no-reply@$domain_name\r\n"
        .'Content-Type: text/html; charset=UTF-8';

    mail("info@$domain_name", $subject, $html, $headers);

}
