#!/usr/bin/php
<?php

include_once 'fns/ensure_table.php';
ensure_table('connections', [
    'can_send_bookmark' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'can_send_channel' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'can_send_contact' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'can_send_file' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'can_send_note' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'can_send_task' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'connected_id_users' => [
        'type' => 'bigint(20) unsigned',
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
    'num_edits' => [
        'type' => 'bigint(20) unsigned',
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'username' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
]);
