<?php

namespace SubscribedChannels;

function editPublisherUser ($mysqli,
    $publisher_id_users, $publisher_username) {

    $publisher_username = $mysqli->real_escape_string($publisher_username);
    $sql = 'update subscribed_channels'
        ." set publisher_username = '$publisher_username'"
        ." where publisher_id_users = $publisher_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
