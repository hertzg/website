<?php

namespace Users\SubscribedChannels;

function addNumber ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_subscribed_channels = num_subscribed_channels + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
