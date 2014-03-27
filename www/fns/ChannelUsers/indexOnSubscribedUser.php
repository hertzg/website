<?php

namespace ChannelUsers;

function indexOnSubscribedUser ($mysqli, $subscribed_id_users) {
    $sql = 'select * from channel_users'
        ." where subscribed_id_users = $subscribed_id_users";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
