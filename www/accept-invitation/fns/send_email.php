<?php

function send_email ($username) {

    $escapedUsername = htmlspecialchars($username);
    $html =
        '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$escapedUsername Accepted Invitation</title>"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
            .'</head>'
            .'<body>'
                ."<b>$escapedUsername</b> has accepted an invitation."
            .'</body>'
        .'</html>';

    $subject = mb_encode_mimeheader("$username Accepted Invitation", 'UTF-8');

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/DomainName/get.php";
    $headers =
        'From: no-reply@'.DomainName\get()."\r\n"
        .'Content-Type: text/html; charset=UTF-8';

    include_once "$fnsDir/InfoEmail/get.php";
    mail(InfoEmail\get(), $subject, $html, $headers);

}
