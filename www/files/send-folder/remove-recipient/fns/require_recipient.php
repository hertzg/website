<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_folder.php';
    list($folder, $id, $user) = require_folder($mysqli, '../');

    $fnsDir = __DIR__.'/../../../../fns';
    $valuesKey = 'files/send-folder/values';

    if (!array_key_exists($valuesKey, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect("../?id_folders=$id");
    }

    $values = $_SESSION[$valuesKey];
    $recipients = $values['recipients'];

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');

    if (!array_key_exists($username, $recipients)) {
        include_once "$fnsDir/redirect.php";
        redirect("../?id_folders=$id");
    }

    return [$folder, $id, $username, $user, $values];

}
