<?php

namespace ChannelUsers;

function getOnChannelAndSubscribedUser ($mysqli, $id_channels, $subscribed_id_users) {
    $sql = "select * from channel_users where id_channels = $id_channels"
        ." and subscribed_id_users = $subscribed_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
