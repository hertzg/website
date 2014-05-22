<?php

namespace Notifications;

function editSubscribedChannels ($mysqli, array $ids, $channel_name) {
    $ids = join(', ', $ids);
    $channel_name = $mysqli->real_escape_string($channel_name);
    $sql = "update notifications set channel_name = '$channel_name'"
        ." where id_subscribed_channels in ($ids)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
