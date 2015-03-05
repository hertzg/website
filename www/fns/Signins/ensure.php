<?php

namespace Signins;

function ensure ($mysqli) {
    include_once __DIR__.'/../Table/ensure.php';
    return \Table\ensure($mysqli, 'signins', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'remote_address' => [
            'type' => 'varchar(128)',
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
    ]);
}
