<?php

function send_email ($user, $key) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/get_site_base.php";
    $siteBase = get_site_base();

    include_once "$fnsDir/get_domain_name.php";
    $domain_name = get_domain_name();

    $href = htmlspecialchars(
        "http://$domain_name{$siteBase}reset-password/?".http_build_query([
            'id_users' => $user->id_users,
            'key' => bin2hex($key)
        ])
    );

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

    $headers =
        "From: no-reply@$domain_name\r\n"
        .'Content-Type: text/html; charset=UTF-8';

    mail($user->email, $subject, $html, $headers);

}
