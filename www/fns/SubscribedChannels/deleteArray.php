<?php

namespace SubscribedChannels;

function deleteArray ($mysqli, array $subscribedChannels) {
    if ($subscribedChannels) {
        include_once __DIR__.'/delete.php';
        include_once __DIR__.'/../Notifications/deleteOnSubscribedChannel.php';
        include_once __DIR__.'/../Users/Notifications/addNumber.php';
        include_once __DIR__.'/../Users/SubscribedChannels/addNumber.php';
        foreach ($subscribedChannels as $subscribedChannel) {
            delete($mysqli, $subscribedChannel->id);
            $id_users = $subscribedChannel->subscriber_id_users;
            \Users\SubscribedChannels\addNumber($mysqli, $id_users, -1);
            \Notifications\deleteOnSubscribedChannel($mysqli, $subscribedChannel->id);
            \Users\Notifications\addNumber($mysqli, $id_users,
                -$subscribedChannel->num_notifications);
        }
    }
}
