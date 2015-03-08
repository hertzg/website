<?php

namespace ApiKeyName;

function column ($nullable = false) {
    include_once __DIR__.'/maxLength.php';
    return [
        'type' => 'varchar('.maxLength().')',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
        'nullable' => $nullable,
    ];
}
