<?php

namespace SubscribedChannels;

function indexOnSubscriber ($mysqli, $subscriber_id_users) {
    $sql = 'select * from subscribed_channels'
        ." where subscriber_id_users = $subscriber_id_users"
        .' order by lowercase_name';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
