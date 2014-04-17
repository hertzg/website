<?php

function require_subscriber_locked_channel ($mysqli) {

    include_once __DIR__.'/require_subscribed_channel.php';
    $values = require_subscribed_channel($mysqli);
    list($subscribedChannel, $id, $user) = $values;

    if (!$subscribedChannel->subscriber_locked) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return $values;

}
