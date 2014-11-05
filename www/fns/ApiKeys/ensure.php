<?php

namespace ApiKeys;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once __DIR__.'/../Table/ensure.php';
    return \Table\ensure($mysqli, 'api_keys', [
        'access_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'can_read_bookmarks' => [
            'type' => 'tinyint(4)',
        ],
        'can_read_channels' => [
            'type' => 'tinyint(4)',
        ],
        'can_read_contacts' => [
            'type' => 'tinyint(4)',
        ],
        'can_read_events' => [
            'type' => 'tinyint(4)',
        ],
        'can_read_files' => [
            'type' => 'tinyint(4)',
        ],
        'can_read_notes' => [
            'type' => 'tinyint(4)',
        ],
        'can_read_notifications' => [
            'type' => 'tinyint(4)',
        ],
        'can_read_schedules' => [
            'type' => 'tinyint(4)',
        ],
        'can_read_tasks' => [
            'type' => 'tinyint(4)',
        ],
        'can_write_bookmarks' => [
            'type' => 'tinyint(4)',
        ],
        'can_write_channels' => [
            'type' => 'tinyint(4)',
        ],
        'can_write_contacts' => [
            'type' => 'tinyint(4)',
        ],
        'can_write_events' => [
            'type' => 'tinyint(4)',
        ],
        'can_write_files' => [
            'type' => 'tinyint(4)',
        ],
        'can_write_notes' => [
            'type' => 'tinyint(4)',
        ],
        'can_write_notifications' => [
            'type' => 'tinyint(4)',
        ],
        'can_write_schedules' => [
            'type' => 'tinyint(4)',
        ],
        'can_write_tasks' => [
            'type' => 'tinyint(4)',
        ],
        'expire_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
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
        'key' => [
            'type' => "binary($maxLengths[key])",
        ],
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'revision' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);

}