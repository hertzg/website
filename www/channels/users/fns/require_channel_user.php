<?php

function require_channel_user ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/ChannelUsers/get.php';
    $channelUser = ChannelUsers\get($mysqli, $id);

    if (!$channelUser) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$channelUser, $id, $user];

}
