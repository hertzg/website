<?php

namespace SubscribedChannels;

function countOnSubscriber ($mysqli, $subscriber_id_users) {
    $sql = 'select count(*) value from subscribed_channels'
        ." where subscriber_id_users = $subscriber_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
