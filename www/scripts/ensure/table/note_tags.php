#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once '../../../fns/Notes/maxLengths.php';
$maxLengths = Notes\maxLengths();

include_once 'fns/ensure_table.php';
include_once '../../../fns/Tag/maxLength.php';
ensure_table('note_tags', [
    'encrypt' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_notes' => [
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
    'text' => [
        'type' => "varchar($maxLengths[text])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
