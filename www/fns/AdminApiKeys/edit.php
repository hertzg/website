<?php

namespace AdminApiKeys;

function edit ($mysqli, $id, $name, $expire_time, $can_read_invitations,
    $can_read_users, $can_write_invitations, $can_write_users) {

    $name = $mysqli->real_escape_string($name);
    if ($expire_time === null) $expire_time = 'null';
    $can_read_invitations = $can_read_invitations ? '1' : '0';
    $can_read_users = $can_read_users ? '1' : '0';
    $can_write_invitations = $can_write_invitations ? '1' : '0';
    $can_write_users = $can_write_users ? '1' : '0';
    $update_time = time();

    $sql = "update admin_api_keys set name = '$name',"
        ." expire_time = $expire_time,"
        ." can_read_invitations = $can_read_invitations,"
        ." can_read_users = $can_read_users,"
        ." can_write_invitations = $can_write_invitations,"
        ." can_write_users = $can_write_users, update_time = $update_time,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
