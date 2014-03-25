<?php

namespace Users;

function editAnonymousConnection ($mysqli, $idusers, $can_send_channel) {
    $can_send_channel = $can_send_channel ? '1' : '0';
    $sql = "update users set anonymous_can_send_channel = $can_send_channel"
        ." where idusers = $idusers";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
