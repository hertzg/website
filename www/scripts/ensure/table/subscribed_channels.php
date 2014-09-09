#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('subscribed_channels', [
    'channel_name' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_general_ci',
    ],
    'channel_public' => [
        'type' => 'tinyint(4)',
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_channels' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'num_notifications' => [
        'type' => 'bigint(20) unsigned',
    ],
    'publisher_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'publisher_locked' => [
        'type' => 'tinyint(4)',
    ],
    'publisher_username' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
    'receive_notifications' => [
        'type' => 'tinyint(4)',
    ],
    'subscriber_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'subscriber_locked' => [
        'type' => 'tinyint(4)',
    ],
    'subscriber_username' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
]);
