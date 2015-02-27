<?php

namespace SubscribedChannels;

function editSubscriberUser ($mysqli,
    $subscriber_id_users, $subscriber_username) {

    $subscriber_username = $mysqli->real_escape_string($subscriber_username);
    $sql = 'update subscribed_channels'
        ." set subscriber_username = '$subscriber_username'"
        ." where subscriber_id_users = $subscriber_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
