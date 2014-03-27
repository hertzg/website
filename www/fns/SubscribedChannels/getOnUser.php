<?php

namespace SubscribedChannels;

function getOnUser ($mysqli, $id_users, $id) {
    include_once __DIR__.'/get.php';
    $subscribedChannel = get($mysqli, $id);
    if ($subscribedChannel &&
        $subscribedChannel->id_users == $id_users) {
        return $subscribedChannel;
    }
}
