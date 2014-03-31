<?php

namespace SubscribedChannels;

function deleteOnChannel ($mysqli, $id_channels) {
    $sql = 'delete from subscribed_channels'
        ." where id_channels = $id_channels";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
