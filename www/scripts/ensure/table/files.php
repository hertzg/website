#!/usr/bin/php
<?php

include_once 'fns/ensure_table.php';
ensure_table('files', [
    'content_type' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
    'id_files' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_folders' => [
        'type' => 'bigint(20) unsigned',
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'media_type' => [
        'type' => 'enum('audio','image','video','unknown')',
        'default' => 'unknown',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'name' => [
        'type' => 'varchar(255)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'rename_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'size' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
