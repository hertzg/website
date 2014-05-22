<?php

namespace Notifications;

function editChannel ($mysqli, $id_channels, $channel_name) {

    $channel_name = $mysqli->real_escape_string($channel_name);

    $sql = "update notifications set channel_name = '$channel_name'"
        ." where id_channels = $id_channels";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
