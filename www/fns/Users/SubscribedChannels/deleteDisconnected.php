<?php

namespace Users\SubscribedChannels;

function deleteDisconnected ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/SubscribedChannels/indexPublisherLockedOnSubscriber.php";
    $subscribedChannels = \SubscribedChannels\indexPublisherLockedOnSubscriber(
        $mysqli, $id_users);

    if ($subscribedChannels) {
        include_once "$fnsDir/get_users_connection.php";
        include_once "$fnsDir/Users/get.php";
        foreach ($subscribedChannels as $subscribedChannel) {
            $user = \Users\get($mysqli, $subscribedChannel->publisher_id_users);
            $connection = get_users_connection($mysqli, $user, $id_users);
            if (!$connection['can_send_channel']) {
                include_once "$fnsDir/Users/Channels/Users/delete.php";
                \Users\Channels\Users\delete($mysqli, $subscribedChannel);
            }
        }
    }

}
