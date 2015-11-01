<?php

namespace ConnectionAddress;

function column ($nullable = false) {
    include_once __DIR__.'/maxLength.php';
    return [
        'type' => 'varchar('.maxLength().')',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'nullable' => $nullable,
    ];
}
