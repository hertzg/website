<?php

namespace Users\Channels;

function edit ($mysqli, $channel, $channel_name, $public,
    $receive_notifications, &$changed, $updateApiKey = null) {

    if ($channel->channel_name === $channel_name &&
        (bool)$channel->public === $public &&
        (bool)$channel->receive_notifications === $receive_notifications) {

        return;

    }

    $changed = true;
    $id = $channel->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Channels/edit.php";
    \Channels\edit($mysqli, $id, $channel_name,
        $public, $receive_notifications, $updateApiKey);

    include_once "$fnsDir/SubscribedChannels/editChannel.php";
    \SubscribedChannels\editChannel($mysqli, $id, $channel_name, $public);

    include_once "$fnsDir/Notifications/editChannel.php";
    \Notifications\editChannel($mysqli, $id, $channel_name);

    include_once "$fnsDir/SubscribedChannels/indexOnChannel.php";
    $subscribedChannels = \SubscribedChannels\indexOnChannel($mysqli, $id);

    if ($subscribedChannels) {
        $ids = array_map(function ($subscribedChannel) {
            return $subscribedChannel->id;
        }, $subscribedChannels);
        include_once "$fnsDir/Notifications/editSubscribedChannels.php";
        \Notifications\editSubscribedChannels($mysqli, $ids, $channel_name);
    }

}
