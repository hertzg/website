<?php

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../lib/mysqli.php';

$sql =
    'alter table api_keys'
    .' add can_read_bookmarks tinyint not null after access_time,'
    .' add can_read_channels tinyint not null after can_read_bookmarks,'
    .' add can_read_contacts tinyint not null after can_read_channels,'
    .' add can_read_events tinyint not null after can_read_contacts,'
    .' add can_read_files tinyint not null after can_read_events,'
    .' add can_read_folders tinyint not null after can_read_files,'
    .' add can_read_notes tinyint not null after can_read_folders,'
    .' add can_read_notifications tinyint not null after can_read_notes,'
    .' add can_read_schedules tinyint not null after can_read_notifications,'
    .' add can_read_subscribed_channels tinyint not null after can_read_schedules,'
    .' add can_read_tasks tinyint not null after can_read_subscribed_channels,'
    .' add can_write_bookmarks tinyint not null after can_read_tasks,'
    .' add can_write_channels tinyint not null after can_write_bookmarks,'
    .' add can_write_contacts tinyint not null after can_write_channels,'
    .' add can_write_events tinyint not null after can_write_contacts,'
    .' add can_write_files tinyint not null after can_write_events,'
    .' add can_write_folders tinyint not null after can_write_files,'
    .' add can_write_notes tinyint not null after can_write_folders,'
    .' add can_write_notifications tinyint not null after can_write_notes,'
    .' add can_write_schedules tinyint not null after can_write_notifications,'
    .' add can_write_subscribed_channels tinyint not null after can_write_schedules,'
    .' add can_write_tasks tinyint not null after can_write_subscribed_channels';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql =
    'update api_keys set'
    .' can_read_bookmarks = 1,'
    .' can_read_channels = 1,'
    .' can_read_contacts = 1,'
    .' can_read_events = 1,'
    .' can_read_files = 1,'
    .' can_read_folders = 1,'
    .' can_read_notes = 1,'
    .' can_read_notifications = 1,'
    .' can_read_schedules = 1,'
    .' can_read_subscribed_channels = 1,'
    .' can_read_tasks = 1,'
    .' can_write_bookmarks = 1,'
    .' can_write_channels = 1,'
    .' can_write_contacts = 1,'
    .' can_write_events = 1,'
    .' can_write_files = 1,'
    .' can_write_folders = 1,'
    .' can_write_notes = 1,'
    .' can_write_notifications = 1,'
    .' can_write_schedules = 1,'
    .' can_write_subscribed_channels = 1,'
    .' can_write_tasks = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
