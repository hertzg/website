<?php

namespace Notifications;

function deleteOnSubscribedChannel ($mysqli, $subscribed_id_channels) {
    $sql = 'delete from notifications'
        ." where subscribed_id_channels = $subscribed_id_channels";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
