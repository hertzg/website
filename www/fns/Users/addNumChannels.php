<?php

namespace Users;

function addNumChannels ($mysqli, $idusers, $num_channels) {
    $sql = "update users set num_channels = num_channels + $num_channels"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
