<?php

namespace Users;

function clearNumNotifications ($mysqli, $idusers) {
    $sql = 'update users set num_notifications = 0,'
        ." num_new_notifications = 0 where idusers = $idusers";
    $mysqli->query($sql);
}
