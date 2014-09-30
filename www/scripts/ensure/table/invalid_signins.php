#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once 'fns/ensure_table.php';
ensure_table('invalid_signins', [
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'remote_address' => [
        'type' => 'varchar(128)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
]);
