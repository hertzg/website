<?php

namespace Users\Notifications;

function addNumber ($mysqli, $id_users, $num_notifications) {
    $sql = 'update users set'
        ." num_notifications = num_notifications + $num_notifications,"
        ." num_new_notifications = 0, home_num_new_notifications = 0"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
