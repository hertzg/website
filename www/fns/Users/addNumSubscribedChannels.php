<?php

namespace Users;

function addNumSubscribedChannels ($mysqli, $idusers, $num_subscribed_channels) {
    $sql = 'update users set'
        ." num_subscribed_channels = num_subscribed_channels + $num_subscribed_channels"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
