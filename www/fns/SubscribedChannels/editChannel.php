<?php

namespace SubscribedChannels;

function editChannel ($mysqli, $id_channels, $channel_name, $channel_public) {

    $lowercase_name = strtolower($channel_name);
    $lowercase_name = $mysqli->real_escape_string($lowercase_name);

    $channel_name = $mysqli->real_escape_string($channel_name);
    $channel_public = $channel_public ? '1' : '0';

    $sql = "update subscribed_channels set channel_name = '$channel_name',"
        ." lowercase_name = '$lowercase_name', channel_public = $channel_public"
        ." where id_channels = $id_channels";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
