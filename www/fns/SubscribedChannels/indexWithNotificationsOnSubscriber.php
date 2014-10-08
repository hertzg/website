<?php

namespace SubscribedChannels;

function indexWithNotificationsOnSubscriber ($mysqli, $subscriber_id_users) {
    $sql = 'select * from subscribed_channels'
        ." where subscriber_id_users = $subscriber_id_users"
        .' and num_notifications > 1 order by lowercase_name';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
