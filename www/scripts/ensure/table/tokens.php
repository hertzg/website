#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('tokens', [
    'access_time' => [
        'type' => 'bigint(20) unsigned',
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
    'token_text' => [
        'type' => 'binary(16)',
    ],
    'username' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
    'user_agent' => [
        'type' => 'varchar(1024)',
        'nullable' => true,
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
]);
