<?php

function send_email ($user, $key) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/get_absolute_base.php";
    $href = htmlspecialchars(get_absolute_base()."reset-password/?key=$key");

    $title = 'Reset Password for Zvini Account';

    $html =
        '<!DOCTYPE html>'
        .'<html>'
            .'<head>'
                ."<title>$title</title>"
                .'<meta http-equiv="Content-Type"'
                .' content="text/html; charset=UTF-8" />'
            .'</head>'
            .'<body>'
                .'<div>'
                    .'Password reset has been requested for your Zvini account.'
                    .' To reset password visit the following link:'
                .'</div>'
                .'<br />'
                ."<a href=\"$href\">$href</a>"
            .'</body>'
        .'</html>';

    $subject = mb_encode_mimeheader($title, 'UTF-8');

    include_once "$fnsDir/DomainName/get.php";
    $headers =
        'From: no-reply@'.DomainName\get()."\r\n"
        .'Content-Type: text/html; charset=UTF-8';

    mail($user->email, $subject, $html, $headers);

}
