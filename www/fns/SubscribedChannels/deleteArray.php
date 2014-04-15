<?php

namespace SubscribedChannels;

function deleteArray ($mysqli, array $subscribedChannels) {
    if ($subscribedChannels) {
        include_once __DIR__.'/delete.php';
        include_once __DIR__.'/../Users/addNumSubscribedChannels.php';
        foreach ($subscribedChannels as $subscribedChannel) {
            delete($mysqli, $subscribedChannel->id);
            \Users\addNumSubscribedChannels($mysqli,
                $subscribedChannel->subscriber_id_users, -1);
        }
    }
}
