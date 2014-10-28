#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once '../../../fns/Events/maxLengths.php';
$maxLengths = Events\maxLengths();

include_once 'fns/ensure_table.php';
ensure_table('events', [
    'event_time' => [
        'type' => 'bigint(20)',
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
    'revision' => [
        'type' => 'bigint(20) unsigned',
    ],
    'text' => [
        'type' => "varchar($maxLengths[text])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
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
]);
