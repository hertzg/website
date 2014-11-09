<?php

function send_email ($username) {

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

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/DomainName/get.php";
    $headers =
        'From: no-reply@'.DomainName\get()."\r\n"
        .'Content-Type: text/html; charset=UTF-8';

    include_once "$fnsDir/InfoEmail/get.php";
    mail(InfoEmail\get(), $subject, $html, $headers);

}
