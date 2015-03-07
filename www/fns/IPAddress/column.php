<?php

namespace IPAddress;

function column ($nullable = false) {
    return [
        'type' => 'varchar(45)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
        'nullable' => $nullable,
    ];
}
