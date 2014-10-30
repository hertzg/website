<?php

function require_subscribed_channel_notifications ($mysqli) {

    include_once __DIR__.'/../../fns/require_subscribed_channel.php';
    $values = require_subscribed_channel($mysqli, '../');
    list($subscribedChannel, $id, $user) = $values;

    if (!$subscribedChannel->num_notifications) {
        unset($_SESSION['notifications/in-subscribed-channel/messages']);
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect("../?id=$id");
    }

    return [$subscribedChannel, $id, $user];

}
