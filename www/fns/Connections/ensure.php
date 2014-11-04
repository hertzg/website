<?php

namespace Connections;

function ensure ($mysqli) {
    include_once __DIR__.'/../Table/ensure.php';
    include_once __DIR__.'/../Username/maxLength.php';
    return \Table\ensure($mysqli, 'connections', [
        'can_send_bookmark' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'can_send_channel' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'can_send_contact' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'can_send_file' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'can_send_note' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'can_send_task' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'connected_id_users' => [
            'type' => 'bigint(20) unsigned',
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
        'revision' => [
            'type' => 'bigint(20) unsigned',
        ],
        'update_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'username' => [
            'type' => 'varchar('.\Username\maxLength().')',
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
    ]);
}
