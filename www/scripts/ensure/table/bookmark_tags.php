#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('bookmark_tags', [
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_bookmarks' => [
        'type' => 'bigint(20) unsigned',
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'tag_name' => [
        'type' => 'varchar(64)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'title' => [
        'type' => 'varchar(128)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'url' => [
        'type' => 'varchar(2048)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
]);
