<?php

namespace ReceivedPlaces;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Places/maxLengths.php";
    $maxLengths = \Places\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Username/maxLength.php";
    return \Table\ensure($mysqli, 'received_places', [
        'altitude' => [
            'type' => 'double',
            'nullable' => true,
        ],
        'archived' => [
            'type' => 'tinyint(3) unsigned',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'latitude' => ['type' => 'double'],
        'longitude' => ['type' => 'double'],
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'receiver_id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'sender_id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'sender_username' => [
            'type' => 'varchar('.\Username\maxLength().')',
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
        'tags' => [
            'type' => "varchar($maxLengths[tags])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ]);

}