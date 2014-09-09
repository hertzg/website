#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once '../../../fns/Bookmarks/maxLengths.php';
$maxLengths = Bookmarks\maxLengths();

include_once 'fns/ensure_table.php';
include_once '../../../fns/Tag/maxLength.php';
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
        'type' => 'varchar('.Tag\maxLength().')',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
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
