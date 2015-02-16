<?php

namespace PlacePoints;

function ensure ($mysqli) {
    include_once __DIR__.'/../Table/ensure.php';
    return \Table\ensure($mysqli, 'place_points', [
        'altitude' => [
            'type' => 'double',
            'nullable' => true,
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_places' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'latitude' => ['type' => 'double'],
        'longitude' => ['type' => 'double'],
        'update_time' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);
}
