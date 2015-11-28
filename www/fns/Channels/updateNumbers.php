<?php

namespace Channels;

function updateNumbers ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/mysqli_query_object.php";
    $channels = mysqli_query_object($mysqli, 'select * from channels');

    if (!$channels) return;

    include_once __DIR__.'/editNumbers.php';
    include_once "$fnsDir/Notifications/countOnChannel.php";
    include_once "$fnsDir/SubscribedChannels/countPublisherLockedOnChannel.php";

    foreach ($channels as $channel) {
        $id = $channel->id;
        $num_notifications = \Notifications\countOnChannel($mysqli, $id);
        $num_users = \SubscribedChannels\countPublisherLockedOnChannel(
            $mysqli, $id);
        editNumbers($mysqli, $id, $num_notifications, $num_users);
    }

}
