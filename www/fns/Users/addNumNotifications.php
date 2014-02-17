<?php

namespace Users;

function addNumNotifications ($mysqli, $idusers, $numnotifications) {
    mysqli_query(
        $mysqli,
        'update users set'
        ." numnotifications = numnotifications + $numnotifications"
        ." where idusers = $idusers"
    );
}
