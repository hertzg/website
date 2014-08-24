<?php

namespace ApiKeys;

function add ($mysqli, $id_users, $name, $expire_time, $can_read_bookmarks,
    $can_read_channels, $can_read_contacts, $can_read_events, $can_read_files,
    $can_read_notes, $can_read_notifications, $can_read_schedules,
    $can_read_tasks, $can_write_bookmarks, $can_write_channels,
    $can_write_contacts, $can_write_events, $can_write_files, $can_write_notes,
    $can_write_notifications, $can_write_schedules, $can_write_tasks) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $key = openssl_random_pseudo_bytes($maxLengths['key']);
    $key = $mysqli->real_escape_string($key);
    $name = $mysqli->real_escape_string($name);
    if ($expire_time === null) $expire_time = 'null';
    $can_read_bookmarks = $can_read_bookmarks ? '1' : '0';
    $can_read_channels = $can_read_channels ? '1' : '0';
    $can_read_contacts = $can_read_contacts ? '1' : '0';
    $can_read_events = $can_read_events ? '1' : '0';
    $can_read_files = $can_read_files ? '1' : '0';
    $can_read_notes = $can_read_notes ? '1' : '0';
    $can_read_notifications = $can_read_notifications ? '1' : '0';
    $can_read_schedules = $can_read_schedules ? '1' : '0';
    $can_read_tasks = $can_read_tasks ? '1' : '0';
    $can_write_bookmarks = $can_write_bookmarks ? '1' : '0';
    $can_write_channels = $can_write_channels ? '1' : '0';
    $can_write_contacts = $can_write_contacts ? '1' : '0';
    $can_write_events = $can_write_events ? '1' : '0';
    $can_write_files = $can_write_files ? '1' : '0';
    $can_write_notes = $can_write_notes ? '1' : '0';
    $can_write_notifications = $can_write_notifications ? '1' : '0';
    $can_write_schedules = $can_write_schedules ? '1' : '0';
    $can_write_tasks = $can_write_tasks ? '1' : '0';
    $insert_time = time();

    $sql = 'insert into api_keys (id_users, `key`, name, expire_time,'
        .' can_read_bookmarks, can_read_channels, can_read_contacts,'
        .' can_read_events, can_read_files, can_read_notes,'
        .' can_read_notifications, can_read_schedules, can_read_tasks,'
        .' can_write_bookmarks, can_write_channels, can_write_contacts,'
        .' can_write_events, can_write_files, can_write_notes,'
        .' can_write_notifications, can_write_schedules,'
        .' can_write_tasks, insert_time)'
        ." values ($id_users, '$key', '$name', $expire_time,"
        ." $can_read_bookmarks, $can_read_channels, $can_read_contacts,"
        ." $can_read_events, $can_read_files, $can_read_notes,"
        ." $can_read_notifications, $can_read_schedules, $can_read_tasks,"
        ." $can_write_bookmarks, $can_write_channels, $can_write_contacts,"
        ." $can_write_events, $can_write_files, $can_write_notes,"
        ." $can_write_notifications, $can_write_schedules,"
        ." $can_write_tasks, $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
