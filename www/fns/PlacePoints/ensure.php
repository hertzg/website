<?php

namespace PlacePoints;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    $nullable_unsigned_bigint = [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ];

    include_once "$fnsDir/ApiKeyName/column.php";
    $apiKeyNameColumn = \ApiKeyName\column(true);

    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'place_points', [
        'altitude' => [
            'type' => 'double',
            'nullable' => true,
        ],
        'deleted' => ['type' => 'tinyint(3) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_places' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => $nullable_unsigned_bigint,
        'insert_api_key_name' => $apiKeyNameColumn,
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'latitude' => ['type' => 'double'],
        'longitude' => ['type' => 'double'],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'update_api_key_id' => $nullable_unsigned_bigint,
        'update_api_key_name' => $apiKeyNameColumn,
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
