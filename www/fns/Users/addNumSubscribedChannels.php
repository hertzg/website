<?php

namespace Users;

function addNumSubscribedChannels ($mysqli, $id_users, $num_subscribed_channels) {
    $sql = 'update users set'
        ." num_subscribed_channels = num_subscribed_channels + $num_subscribed_channels"
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
