<?php

namespace Users;

function addNumOtherChannels ($mysqli, $idusers, $num_other_channels) {
    $sql = 'update users set'
        ." num_other_channels = num_other_channels + $num_other_channels"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
