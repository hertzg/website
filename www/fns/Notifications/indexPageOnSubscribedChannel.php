<?php

namespace Notifications;

function indexPageOnSubscribedChannel ($mysqli,
    $id_subscribed_channels, $offset, $limit, &$total) {

    $sql = 'select count(*) total from notifications'
        ." where id_subscribed_channels = $id_subscribed_channels";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = 'select * from notifications'
        ." where id_subscribed_channels = $id_subscribed_channels"
        ." order by insert_time limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
