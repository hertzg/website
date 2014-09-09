#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('deleted_items', [
    'data_json' => [
        'type' => 'text',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'data_type' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
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
]);
