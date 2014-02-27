<?php

namespace Users;

function clearNumNotifications ($mysqli, $idusers) {
    $sql = 'update users set numnotifications = 0'
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
