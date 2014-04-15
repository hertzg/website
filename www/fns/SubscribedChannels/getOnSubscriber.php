<?php

namespace SubscribedChannels;

function getOnSubscriber ($mysqli, $subscriber_id_users, $id) {
    include_once __DIR__.'/get.php';
    $subscribedChannel = get($mysqli, $id);
    if ($subscribedChannel &&
        $subscribedChannel->subscriber_id_users == $subscriber_id_users) {
        return $subscribedChannel;
    }
}
