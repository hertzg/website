<?php

namespace SubscribedChannels;

function indexOnChannel ($mysqli, $id_channels) {
    $sql = "select * from subscribed_channels where id_channels = $id_channels"
        .' order by subscriber_username';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
