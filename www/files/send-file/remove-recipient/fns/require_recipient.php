<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_file.php';
    list($file, $id, $user) = require_file($mysqli, '../');

    $fnsDir = __DIR__.'/../../../../fns';
    $valuesKey = 'files/send-file/values';

    if (!array_key_exists($valuesKey, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect("../?id=$id");
    }

    $recipients = $_SESSION[$valuesKey]['recipients'];

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');

    if (!array_key_exists($username, $recipients)) {
        include_once "$fnsDir/redirect.php";
        redirect("../?id=$id");
    }

    return [$file, $id, $username, $user, $recipients];

}
