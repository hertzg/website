<?php

namespace Users;

function clearNumNewNotifications ($mysqli, $idusers) {
    $sql = 'update users set num_new_notifications = 0,'
        .' num_new_notifications_for_home = 0'
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
