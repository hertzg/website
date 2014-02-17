<?php

namespace Channels;

function clearNumNotificationsOnUser ($mysqli, $idusers) {
    mysqli_query(
        $mysqli,
        'update channels set numnotifications = 0'
        ." where idusers = $idusers"
    );
}

