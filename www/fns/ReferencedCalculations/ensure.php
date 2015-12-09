<?php

namespace ReferencedCalculations;

function ensure ($mysqli) {
    include_once __DIR__.'/../Table/ensure.php';
    return \Table\ensure($mysqli, 'referenced_calculations', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_calculations' => [
            'type' => 'bigint(20) unsigned',
        ],
        'referenced_id_calculations' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);
}
