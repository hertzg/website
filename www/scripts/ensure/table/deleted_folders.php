#!/usr/bin/php
<?php

include_once 'fns/ensure_table.php';
ensure_table('deleted_folders', [
    'id_deleted_items' => [
        'type' => 'bigint(20) unsigned',
    ],
    'id_folders' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'name' => [
        'type' => 'varchar(255)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'parent_id_folders' => [
        'type' => 'bigint(20) unsigned',
    ],
    'rename_time' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
