<?php

namespace ContactPhotos;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tag/maxLength.php";
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
