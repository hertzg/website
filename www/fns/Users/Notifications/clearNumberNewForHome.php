<?php

namespace Users\Notifications;

function clearNumberNewForHome ($mysqli, $user) {

    $user->home_num_new_notifications = 0;

    $sql = 'update users set home_num_new_notifications = 0'
        ." where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
