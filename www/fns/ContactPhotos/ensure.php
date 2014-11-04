<?php

namespace ContactPhotos;

function ensure ($mysqli) {
    include_once __DIR__.'/../Tag/maxLength.php';
    include_once __DIR__.'/../Table/ensure.php';
    return \Table\ensure($mysqli, 'contact_photos', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'num_refs' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);
}
