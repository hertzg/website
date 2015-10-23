<?php

namespace Username;

function lowercaseColumn () {
    include_once __DIR__.'/maxLength.php';
    return [
        'type' => 'varchar('.maxLength().')',
        'characterSet' => 'ascii',
        'collation' => 'ascii_general_ci',
    ];
}
