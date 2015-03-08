<?php

namespace FullName;

function column () {
    include_once __DIR__.'/maxLength.php';
    return [
        'type' => 'varchar('.maxLength().')',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ];
}
