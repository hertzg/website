#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once '../../../fns/Tasks/maxLengths.php';
$maxLengths = Tasks\maxLengths();

include_once 'fns/ensure_table.php';
ensure_table('received_tasks', [
    'archived' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'deadline_time' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
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
        'type' => "varchar($maxLengths[tags])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'text' => [
        'type' => "varchar($maxLengths[text])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'top_priority' => [
        'type' => 'tinyint(3) unsigned',
    ],
]);
