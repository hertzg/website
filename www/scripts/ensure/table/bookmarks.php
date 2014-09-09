#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('bookmarks', [
    'id_bookmarks' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'num_edits' => [
        'type' => 'bigint(20) unsigned',
    ],
    'tags' => [
        'type' => 'varchar(256)',
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
