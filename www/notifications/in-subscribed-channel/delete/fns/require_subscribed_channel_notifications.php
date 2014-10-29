<?php

function require_subscribed_channel_notifications ($mysqli) {

    include_once __DIR__.'/../../fns/require_subscribed_channel.php';
    $values = require_subscribed_channel($mysqli, '../');
    list($subscribedChannel, $id, $user) = $values;

    if (!$subscribedChannel->num_notifications) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect('../..');
    }

    return [$subscribedChannel, $id, $user];

}
