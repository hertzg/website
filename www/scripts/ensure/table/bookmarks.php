#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once '../../../fns/Bookmarks/maxLengths.php';
$maxLengths = Bookmarks\maxLengths();

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
    'num_tags' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'revision' => [
        'type' => 'bigint(20) unsigned',
    ],
    'tags' => [
        'type' => "varchar($maxLengths[tags])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'tags_json' => [
        'type' => "varchar($maxLengths[tags_json])",
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
    'title' => [
        'type' => "varchar($maxLengths[title])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'url' => [
        'type' => "varchar($maxLengths[url])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
]);
