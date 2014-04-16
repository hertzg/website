<?php

namespace SubscribedChannels;

function getExistingSubscriber ($mysqli, $id_channels, $subscriber_id_users) {
    $sql = 'select * from subscribed_channels'
        ." where id_channels = $id_channels"
        ." and subscriber_id_users = $subscriber_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
