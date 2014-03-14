<?php

namespace Users;

function showNotifications ($mysqli, $idusers, $show) {
    $show_notifications = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_notifications = $show_notifications"
        ." where idusers = $idusers"
    );
}
