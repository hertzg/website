#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('api_keys', [
    'access_time' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'can_read_bookmarks' => [
        'type' => 'tinyint(4)',
    ],
    'can_read_channels' => [
        'type' => 'tinyint(4)',
    ],
    'can_read_contacts' => [
        'type' => 'tinyint(4)',
    ],
    'can_read_events' => [
        'type' => 'tinyint(4)',
    ],
    'can_read_files' => [
        'type' => 'tinyint(4)',
    ],
    'can_read_notes' => [
        'type' => 'tinyint(4)',
    ],
    'can_read_notifications' => [
        'type' => 'tinyint(4)',
    ],
    'can_read_schedules' => [
        'type' => 'tinyint(4)',
    ],
    'can_read_tasks' => [
        'type' => 'tinyint(4)',
    ],
    'can_write_bookmarks' => [
        'type' => 'tinyint(4)',
    ],
    'can_write_channels' => [
        'type' => 'tinyint(4)',
    ],
    'can_write_contacts' => [
        'type' => 'tinyint(4)',
    ],
    'can_write_events' => [
        'type' => 'tinyint(4)',
    ],
    'can_write_files' => [
        'type' => 'tinyint(4)',
    ],
    'can_write_notes' => [
        'type' => 'tinyint(4)',
    ],
    'can_write_notifications' => [
        'type' => 'tinyint(4)',
    ],
    'can_write_schedules' => [
        'type' => 'tinyint(4)',
    ],
    'can_write_tasks' => [
        'type' => 'tinyint(4)',
    ],
    'expire_time' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'key' => [
        'type' => 'binary(32)',
    ],
    'name' => [
        'type' => 'varchar(64)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'num_edits' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
