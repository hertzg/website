<?php

namespace SubscribedChannels;

function deleteContainingUser ($mysqli, $id_users) {

    include_once __DIR__.'/../mysqli_query_object.php';

    $sql = 'select * from subscribed_channels'
        ." where subscriber_id_users = $id_users";
    $subscribedChannels = mysqli_query_object($mysqli, $sql);
    if ($subscribedChannels) {
        include_once __DIR__.'/delete.php';
        include_once __DIR__.'/../Channels/addNumUsers.php';
        foreach ($subscribedChannels as $subscribedChannel) {
            delete($mysqli, $subscribedChannel->id);
            if ($subscribedChannel->publisher_locked) {
                \Channels\addNumUsers($mysqli,
                    $subscribedChannel->id_channels, -1);
            }
        }
    }

    $sql = 'select * from subscribed_channels'
        ." where publisher_id_users = $id_users";
    $subscribedChannels = mysqli_query_object($mysqli, $sql);

    include_once __DIR__.'/deleteArray.php';
    deleteArray($mysqli, $subscribedChannels);

}
