<?php

namespace CalculationDepends;

function ensure ($mysqli) {
    include_once __DIR__.'/../Table/ensure.php';
    return \Table\ensure($mysqli, 'calculation_depends', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_calculations' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'depend_id_calculations' => ['type' => 'bigint(20) unsigned'],
    ]);
}
