<?php

namespace Notifications;

function deleteOnSubscribedChannel ($mysqli, $id_subscribed_channels) {
    $sql = 'delete from notifications'
        ." where id_subscribed_channels = $id_subscribed_channels";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
