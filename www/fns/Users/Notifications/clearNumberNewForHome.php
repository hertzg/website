<?php

namespace Users\Notifications;

function clearNumberNewForHome ($mysqli, $id_users) {
    $sql = 'update users set home_num_new_notifications = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
