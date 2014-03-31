<?php

namespace Users;

function clearNumNewNotifications ($mysqli, $id_users) {
    $sql = 'update users set num_new_notifications = 0,'
        .' num_new_notifications_for_home = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
