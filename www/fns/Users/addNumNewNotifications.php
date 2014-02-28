<?php

namespace Users;

function addNumNewNotifications ($mysqli, $idusers, $num_new_notifications) {
    $sql = 'update users set'
        ." num_notifications = num_notifications + $num_new_notifications,"
        ." num_new_notifications = num_new_notifications + $num_new_notifications"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
