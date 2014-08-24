<?php

namespace Notifications;

function indexPageOnSubscribedChannel ($mysqli,
    $id_subscribed_channels, $offset, $limit, &$total) {

    $fromWhere = 'from notifications'
        ." where id_subscribed_channels = $id_subscribed_channels";

    $sql = "select count(*) total $fromWhere";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * $fromWhere order by insert_time"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
