<?php

namespace Notifications;

function countOnChannel ($mysqli, $id_channels) {
    $sql = "select count(*) value from notifications"
        ." where id_channels = $id_channels";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
