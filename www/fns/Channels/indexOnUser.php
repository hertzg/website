<?php

namespace Channels;

function indexOnUser ($mysqli, $id_users) {

    $sql = "select * from channels where id_users = $id_users";
    include_once __DIR__.'/../mysqli_query_object.php';
    $channels = mysqli_query_object($mysqli, $sql);

    usort($channels, function ($a, $b) {
        return strcasecmp($a->channel_name, $b->channel_name);
    });

    return $channels;

}
