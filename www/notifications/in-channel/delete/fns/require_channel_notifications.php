<?php

function require_channel_notifications ($mysqli) {

    include_once __DIR__.'/../../fns/require_channel.php';
    list($channel, $id, $user) = require_channel($mysqli, '../');

    if (!$channel->num_notifications) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect('../..');
    }

    return [$channel, $id, $user];

}
