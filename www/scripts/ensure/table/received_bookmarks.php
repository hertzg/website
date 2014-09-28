#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once '../../../fns/Bookmarks/maxLengths.php';
$maxLengths = Bookmarks\maxLengths();

include_once 'fns/ensure_table.php';
include_once '../../../fns/Username/maxLength.php';
ensure_table('received_bookmarks', [
    'archived' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'receiver_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'sender_id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'sender_username' => [
        'type' => 'varchar('.Username\maxLength().')',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
    'tags' => [
        'type' => "varchar($maxLengths[tags])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'title' => [
        'type' => "varchar($maxLengths[title])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'url' => [
        'type' => "varchar($maxLengths[url])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
]);
