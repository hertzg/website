#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once '../../../fns/Files/maxLengths.php';
$maxLengths = Files\maxLengths();

include_once 'fns/ensure_table.php';
ensure_table('received_folder_files', [
    'content_type' => [
        'type' => "varchar($maxLengths[content_type])",
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
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
    'media_type' => [
        'type' => "enum('archive','audio','image','text','unknown','video')",
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'name' => [
        'type' => "varchar($maxLengths[name])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'parent_id' => [
        'type' => 'bigint(20) unsigned',
    ],
    'size' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
