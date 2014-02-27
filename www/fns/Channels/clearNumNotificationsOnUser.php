<?php

namespace Channels;

function clearNumNotificationsOnUser ($mysqli, $idusers) {
    $sql = 'update channels set numnotifications = 0'
        ." where idusers = $idusers";
    $mysqli->query($sql);
}

