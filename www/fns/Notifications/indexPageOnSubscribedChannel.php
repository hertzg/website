<?php

namespace Notifications;

function indexPageOnSubscribedChannel ($mysqli,
    $id_subscribed_channels, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    $fromWhere = 'from notifications'
        ." where id_subscribed_channels = $id_subscribed_channels";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by insert_time"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
