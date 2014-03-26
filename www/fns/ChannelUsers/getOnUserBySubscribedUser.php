<?php

namespace ChannelUsers;

function getOnUserBySubscribedUser ($mysqli, $id_users, $subscribed_id_users) {
    $sql = "select * from channel_users where id_users = $id_users"
        ." and subscribed_id_users = $subscribed_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
