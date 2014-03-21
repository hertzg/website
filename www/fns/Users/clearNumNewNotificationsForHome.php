<?php

namespace Users;

function clearNumNewNotificationsForHome ($mysqli, $idusers) {
    $sql = 'update users set num_new_notifications_for_home = 0'
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
