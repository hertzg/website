<?php

namespace SubscribedChannels;

function deleteContainingUser ($mysqli, $id_users) {

    $sql = 'delete from subscribed_channels'
        ." where subscriber_id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    $sql = "select * from subscribed_channels where id_users = $id_users";
    include_once __DIR__.'/../mysqli_query_object.php';
    $subscribedChannels = mysqli_query_object($mysqli, $sql);
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
