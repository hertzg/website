<?php

namespace SubscribedChannels;

function updateNumbers ($mysqli) {

    $fnsDir = __DIR__.'/..';

    $sql = 'select * from subscribed_channels';
    include_once "$fnsDir/mysqli_query_object.php";
    $subscribed_channels = mysqli_query_object($mysqli, $sql);

    if (!$subscribed_channels) return;

    include_once __DIR__.'/editNumbers.php';
    include_once "$fnsDir/Notifications/countOnSubscribedChannel.php";
    foreach ($subscribed_channels as $subscribed_channel) {
        $id = $subscribed_channel->id;
        $num_notifications = \Notifications\countOnSubscribedChannel(
            $mysqli, $id);
        editNumbers($mysqli, $id, $num_notifications);
    }

}
