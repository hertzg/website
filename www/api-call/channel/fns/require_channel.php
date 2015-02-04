<?php

function require_channel ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Channels/getOnUser.php";
    $channel = Channels\getOnUser($mysqli, $id_users, $id);

    if (!$channel) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CHANNEL_NOT_FOUND');
    }

    return $channel;

}
