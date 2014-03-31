<?php

namespace Users;

function showNotifications ($mysqli, $id_users, $show) {
    $show_notifications = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_notifications = $show_notifications"
        ." where id_users = $id_users"
    );
}
