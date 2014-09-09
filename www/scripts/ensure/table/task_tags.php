#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once '../../../fns/Tasks/maxLengths.php';
$maxLengths = Tasks\maxLengths();

include_once 'fns/ensure_table.php';
include_once '../../../fns/Tag/maxLength.php';
ensure_table('task_tags', [
    'deadline_time' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_tasks' => [
        'type' => 'bigint(20) unsigned',
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'tags' => [
        'type' => "varchar($maxLengths[tags])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
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
    'top_priority' => [
        'type' => 'tinyint(4) unsigned',
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
