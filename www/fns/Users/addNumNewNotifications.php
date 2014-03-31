<?php

namespace Users;

function addNumNewNotifications ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_notifications = num_notifications + $n,"
        ." num_new_notifications = num_new_notifications + $n,"
        ." num_new_notifications_for_home = num_new_notifications_for_home + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
