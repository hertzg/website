<?php

namespace SubscribedChannels;

function clearNumNotificationsOnSubscriber ($mysqli, $subscriber_id_users) {
    $sql = 'update subscribed_channels set num_notifications = 0'
        ." where subscriber_id_users = $subscriber_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
