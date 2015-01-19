#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$time = time();

include_once '../fns/Users/emailExpireDays.php';
$access_time = $time - Users\emailExpireDays() * 24 * 60 * 60;

$sql = 'select * from users where email_expire_time is null'
    ." and access_time < $access_time limit 10";
$users = mysqli_query_object($mysqli, $sql);

if ($users) {

    include_once '../fns/Users/expireDays.php';
    $expireDays = Users\expireDays();

    include_once '../fns/SiteProtocol/get.php';
    $siteProtocol = SiteProtocol\get();

    include_once '../fns/DomainName/get.php';
    $domainName = DomainName\get();

    include_once '../fns/SiteBase/get.php';
    $siteBase = SiteBase\get();

    $headers =
        "From: no-reply@$domainName\r\n"
        .'Content-Type: text/html; charset=UTF-8';

    include_once '../fns/Users/editEmailExpireTime.php';
    foreach ($users as $user) {

        Users\editEmailExpireTime($mysqli, $user->id_users, $time);

        $email = $user->email;
        if ($email === '') continue;

        $expireDate = date('F d, Y', $time + $expireDays * 24 * 60 * 60);

        $subject = 'Your Zvini Account is Expiring';
        $href = "$siteProtocol://$domainName{$siteBase}sign-in/?username="
            .rawurlencode($user->username);

        $html =
            '<!DOCTYPE html>'
            .'<html>'
                .'<head>'
                    ."<title>$subject</title>"
                    .'<meta http-equiv="Content-Type"'
                    .' content="text/html; charset=UTF-8" />'
                .'</head>'
                .'<body>'
                    .'Hello,<br /><br />'
                    .'You haven\'t signed in in Zvini for a long time.'
                    ." Your account is about to expire in $expireDays days."
                    .' Expiring the account will result in the loss'
                    .' of all your data. To avoid this you should'
                    ." sign in once before $expireDate."
                    .' You can sign at the following address:'
                    ." <a href=\"$href\">$href</a>"
                .'</body>'
            .'</html>';

        mail($email, $subject, $html, $headers);

    }

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
