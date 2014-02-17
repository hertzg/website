<?php

namespace Notifications;

function indexOnUserChannel ($mysqli, $idusers, $idchannels) {
    $sql = 'select * from notifications'
        ." where idusers = $idusers and idchannels = $idchannels"
        .' order by inserttime';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
