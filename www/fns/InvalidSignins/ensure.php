<?php

namespace InvalidSignins;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Username/maxLength.php";
    return \Table\ensure($mysqli, 'invalid_signins', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'username' => [
            'type' => 'varchar('.\Username\maxLength().')',
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
        'remote_address' => [
            'type' => 'varchar(128)',
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
    ]);

}
