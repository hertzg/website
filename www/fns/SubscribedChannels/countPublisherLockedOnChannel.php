<?php

namespace SubscribedChannels;

function countPublisherLockedOnChannel ($mysqli, $id_channels) {
    $sql = 'select count(*) value from subscribed_channels'
        ." where id_channels = $id_channels and publisher_locked = 1";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
