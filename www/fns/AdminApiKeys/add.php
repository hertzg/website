<?php

namespace AdminApiKeys;

function add ($mysqli, $name, $can_read_invitations,
    $can_read_users, $can_write_invitations, $can_write_users) {

    include_once __DIR__.'/../ApiKey/random.php';
    $key = \ApiKey\random();

    $name = $mysqli->real_escape_string($name);
    $can_read_invitations = $can_read_invitations ? '1' : '0';
    $can_read_users = $can_read_users ? '1' : '0';
    $can_write_invitations = $can_write_invitations ? '1' : '0';
    $can_write_users = $can_write_users ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into admin_api_keys'
        .' (`key`, name, can_read_invitations,'
        .' can_read_users, can_write_invitations,'
        .' can_write_users, insert_time, update_time)'
        ." values ('$key', '$name', $can_read_invitations,"
        ." $can_read_invitations, $can_write_invitations,"
        ." $can_write_users, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
