<?php

namespace Notifications;

function countOnSubscribedChannel ($mysqli, $id_subscribed_channels) {
    $sql = 'select count(*) value from notifications'
        ." where id_subscribed_channels = $id_subscribed_channels";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
