#!/usr/bin/php
<?php

include_once 'fns/ensure_table.php';
ensure_table('channels', [
    'channel_name' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_general_ci',
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
    'num_notifications' => [
        'type' => 'bigint(20) unsigned',
    ],
    'num_users' => [
        'type' => 'int(10) unsigned',
    ],
    'public' => [
        'type' => 'tinyint(4)',
    ],
    'receive_notifications' => [
        'type' => 'tinyint(4)',
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
