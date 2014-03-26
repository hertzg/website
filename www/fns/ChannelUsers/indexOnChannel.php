<?php

namespace ChannelUsers;

function indexOnChannel ($mysqli, $id_channels) {
    $sql = "select * from channel_users where id_channels = $id_channels";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
