<?php

namespace Notifications;

function indexOnSubscribedChannel ($mysqli, $id_subscribed_channels) {
    $sql = 'select * from notifications'
        ." where id_subscribed_channels = $id_subscribed_channels"
        .' order by insert_time';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
