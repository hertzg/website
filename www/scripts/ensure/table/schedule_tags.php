#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once '../../../fns/Schedules/maxLengths.php';
$maxLengths = Schedules\maxLengths();

include_once 'fns/ensure_table.php';
include_once '../../../fns/Tag/maxLength.php';
ensure_table('schedule_tags', [
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_schedules' => [
        'type' => 'bigint(20) unsigned',
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
    'offset' => [
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
