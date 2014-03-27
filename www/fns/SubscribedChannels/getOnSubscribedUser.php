<?php

namespace SubscribedChannels;

function getOnSubscribedUser ($mysqli, $subscribed_id_users, $id) {
    include_once __DIR__.'/get.php';
    $subscribedChannel = get($mysqli, $id);
    if ($subscribedChannel &&
        $subscribedChannel->subscribed_id_users == $subscribed_id_users) {
        return $subscribedChannel;
    }
}
