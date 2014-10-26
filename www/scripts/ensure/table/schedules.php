#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once '../../../fns/Schedules/maxLengths.php';
$maxLengths = Schedules\maxLengths();

include_once 'fns/ensure_table.php';
ensure_table('schedules', [
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'interval' => [
        'type' => 'bigint(20) unsigned',
    ],
    'num_tags' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'offset' => [
        'type' => 'bigint(20) unsigned',
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
    'text' => [
        'type' => "varchar($maxLengths[text])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
