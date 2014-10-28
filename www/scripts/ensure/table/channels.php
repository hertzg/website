#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once '../../../fns/Channels/maxLengths.php';
$maxLengths = Channels\maxLengths();

include_once 'fns/ensure_table.php';
ensure_table('channels', [
    'channel_name' => [
        'type' => "varchar($maxLengths[channel_name])",
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
    'insert_api_key_id' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'insert_api_key_name' => [
        'type' => "varchar($maxLengths[insert_api_key_name])",
        'nullable' => true,
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'lowercase_name' => [
        'type' => "varchar($maxLengths[lowercase_name])",
        'characterSet' => 'ascii',
        'collation' => 'ascii_general_ci',
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
    'revision' => [
        'type' => 'bigint(20) unsigned',
    ],
    'update_api_key_id' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'update_api_key_name' => [
        'type' => "varchar($maxLengths[update_api_key_name])",
        'nullable' => true,
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'username' => [
        'type' => "varchar($maxLengths[username])",
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
]);
