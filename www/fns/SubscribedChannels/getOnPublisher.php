<?php

namespace SubscribedChannels;

function getOnPublisher ($mysqli, $publisher_id_users, $id) {
    include_once __DIR__.'/get.php';
    $subscribedChannel = get($mysqli, $id);
    if ($subscribedChannel &&
        $subscribedChannel->publisher_id_users == $publisher_id_users) {
        return $subscribedChannel;
    }
}
