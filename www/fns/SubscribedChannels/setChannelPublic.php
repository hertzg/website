<?php

namespace SubscribedChannels;

function setChannelPublic ($mysqli, $id_channels, $channel_public) {
    $channel_public = $channel_public ? '1' : '0';
    $sql = "update subscribed_channels set channel_public = $channel_public"
        ." where id_channels = $id_channels";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
