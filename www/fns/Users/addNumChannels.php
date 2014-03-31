<?php

namespace Users;

function addNumChannels ($mysqli, $id_users, $num_channels) {
    $sql = "update users set num_channels = num_channels + $num_channels"
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
