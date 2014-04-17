<?php

namespace SubscribedChannels;

function indexPublisherLockedOnChannel ($mysqli, $id_channels) {
    $sql = "select * from subscribed_channels where id_channels = $id_channels"
        .' and publisher_locked = 1 order by subscriber_username';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
