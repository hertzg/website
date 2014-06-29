<?php

namespace Users\Notifications;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_notifications = num_notifications + $n,"
        ." num_new_notifications = num_new_notifications + $n,"
        ." home_num_new_notifications = home_num_new_notifications + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
