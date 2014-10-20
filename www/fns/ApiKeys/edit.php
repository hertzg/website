<?php

namespace ApiKeys;

function edit ($mysqli, $id, $name, $expire_time, $can_read_bookmarks,
    $can_read_channels, $can_read_contacts, $can_read_events, $can_read_files,
    $can_read_notes, $can_read_notifications, $can_read_schedules,
    $can_read_tasks, $can_write_bookmarks, $can_write_channels,
    $can_write_contacts, $can_write_events, $can_write_files, $can_write_notes,
    $can_write_notifications, $can_write_schedules, $can_write_tasks) {

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

    $sql = "update api_keys set name = '$name', expire_time = $expire_time,"
        ." can_read_bookmarks = $can_read_bookmarks,"
        ." can_read_channels = $can_read_channels,"
        ." can_read_contacts = $can_read_contacts,"
        ." can_read_events = $can_read_events,"
        ." can_read_files = $can_read_files,"
        ." can_read_notes = $can_read_notes,"
        ." can_read_notifications = $can_read_notifications,"
        ." can_read_schedules = $can_read_schedules,"
        ." can_read_tasks = $can_read_tasks,"
        ." can_write_bookmarks = $can_write_bookmarks,"
        ." can_write_channels = $can_write_channels,"
        ." can_write_contacts = $can_write_contacts,"
        ." can_write_events = $can_write_events,"
        ." can_write_files = $can_write_files,"
        ." can_write_notes = $can_write_notes,"
        ." can_write_notifications = $can_write_notifications,"
        ." can_write_schedules = $can_write_schedules,"
        ." can_write_tasks = $can_write_tasks,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
