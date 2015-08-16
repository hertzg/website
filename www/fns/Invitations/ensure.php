<?php

namespace Invitations;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once __DIR__.'/maxLengths.php';
    include_once "$fnsDir/LinkKey/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'invitations', [
        'note' => [
            'type' => 'varchar('.maxLengths()['note'].')',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'key' => \LinkKey\column(),
    ]);

}
