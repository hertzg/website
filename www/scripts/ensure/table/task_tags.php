#!/usr/bin/php
<?php

include_once 'fns/ensure_table.php';
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
        'type' => 'varchar(256)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'tag_name' => [
        'type' => 'varchar(64)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'text' => [
        'type' => 'varchar(128)',
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
