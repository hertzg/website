#!/usr/bin/php
<?php

include_once 'fns/ensure_table.php';
ensure_table('received_folders', [
    'archived' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'committed' => [
        'type' => 'tinyint(4)',
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'name' => [
        'type' => 'varchar(255)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'receiver_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'sender_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'sender_username' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
]);
