<?php

namespace Users\Channels;

function edit ($mysqli, $id, $channel_name, $public, $receive_notifications) {

    include_once __DIR__.'/../../Channels/edit.php';
    \Channels\edit($mysqli, $id, $channel_name,
        $public, $receive_notifications);

    include_once __DIR__.'/../../SubscribedChannels/editChannel.php';
    \SubscribedChannels\editChannel($mysqli, $id, $channel_name, $public);

    include_once __DIR__.'/../../Notifications/editChannel.php';
    \Notifications\editChannel($mysqli, $id, $channel_name);

}
