#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('received_folder_subfolders', [
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_received_folders' => [
        'type' => 'bigint(20) unsigned',
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'name' => [
        'type' => 'varchar(255)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'parent_id' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
