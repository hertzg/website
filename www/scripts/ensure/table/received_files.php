#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('received_files', [
    'archived' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'committed' => [
        'type' => 'tinyint(4)',
    ],
    'content_type' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'media_type' => [
        'type' => "enum('audio','image','video','unknown')",
        'default' => 'unknown',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
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
    'size' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
