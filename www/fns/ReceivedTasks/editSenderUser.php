<?php

namespace ReceivedTasks;

function editSenderUser ($mysqli, $sender_id_users, $sender_username) {
    $sender_username = $mysqli->real_escape_string($sender_username);
    $sql = "update received_tasks set sender_username = '$sender_username'"
        ." where sender_id_users = $sender_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
