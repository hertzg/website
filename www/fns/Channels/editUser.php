<?php

namespace Channels;

function editUser ($mysqli, $id_users, $username) {
    $username = $mysqli->real_escape_string($username);
    $sql = "update channels set username = '$username'"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
