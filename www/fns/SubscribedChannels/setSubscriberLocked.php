<?php

namespace SubscribedChannels;

function setSubscriberLocked ($mysqli, $id, $subscriber_locked) {
    $subscriber_locked = $subscriber_locked ? '1' : '0';
    $sql = 'update subscribed_channels'
        ." set subscriber_locked = $subscriber_locked"
        ." where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
