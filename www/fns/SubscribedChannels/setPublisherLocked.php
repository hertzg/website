<?php

namespace SubscribedChannels;

function setPublisherLocked ($mysqli, $id, $publisher_locked) {
    $publisher_locked = $publisher_locked ? '1' : '0';
    $sql = 'update subscribed_channels'
        ." set publisher_locked = $publisher_locked"
        ." where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
