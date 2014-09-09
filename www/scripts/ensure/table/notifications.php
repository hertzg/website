#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('notifications', [
    'channel_name' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_general_ci',
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_channels' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'id_subscribed_channels' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'text' => [
        'type' => 'text',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
]);
