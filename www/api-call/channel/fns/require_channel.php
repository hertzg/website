<?php

function require_channel ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Channels/get.php";
    $channel = Users\Channels\get($mysqli, $user, $id);

    if (!$channel) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CHANNEL_NOT_FOUND');
    }

    return $channel;

}
