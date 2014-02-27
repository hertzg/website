<?php

namespace Users;

function addNumNotifications ($mysqli, $idusers, $numnotifications) {
    $sql = 'update users set'
        ." numnotifications = numnotifications + $numnotifications"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
