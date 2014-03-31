<?php

namespace Users;

function editAnonymousConnection ($mysqli, $id_users, $can_send_channel) {
    $can_send_channel = $can_send_channel ? '1' : '0';
    $sql = "update users set anonymous_can_send_channel = $can_send_channel"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
