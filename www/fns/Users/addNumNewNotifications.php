<?php

namespace Users;

function addNumNewNotifications ($mysqli, $idusers, $n) {
    $sql = 'update users set'
        ." num_notifications = num_notifications + $n,"
        ." num_new_notifications = num_new_notifications + $n,"
        ." num_new_notifications_for_home = num_new_notifications_for_home + $n"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
