#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('received_bookmarks', [
    'archived' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
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
    'tags' => [
        'type' => 'varchar(256)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'title' => [
        'type' => 'varchar(128)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'url' => [
        'type' => 'varchar(2048)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
]);
