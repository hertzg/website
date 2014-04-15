<?php

namespace SubscribedChannels;

function indexOnSubscribedUser ($mysqli, $subscriber_id_users) {
    $sql = 'select * from subscribed_channels'
        ." where subscriber_id_users = $subscriber_id_users";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
