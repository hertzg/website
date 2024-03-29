<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../fns/require_stage.php';
    list($user, $stageValues, $id, $folder) = require_stage($mysqli, '../');

    $fnsDir = __DIR__.'/../../../../../fns';
    $valuesKey = 'files/rename-folder/send/values';

    if (!array_key_exists($valuesKey, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect("../?id_folders=$id");
    }

    $recipients = $_SESSION[$valuesKey]['recipients'];

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');

    if (!array_key_exists($username, $recipients)) {
        include_once "$fnsDir/redirect.php";
        redirect("../?id_folders=$id");
    }

    return [$folder, $id, $username, $user, $recipients];

}
