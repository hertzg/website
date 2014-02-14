<?php

namespace Users;

function clearNumNotifications ($mysqli, $idusers) {
    mysqli_query(
        $mysqli,
        'update users set numnotifications = 0'
        ." where idusers = $idusers"
    );
}
