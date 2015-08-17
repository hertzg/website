<?php

namespace Theme\Brightness;

function column () {
    include_once __DIR__.'/index.php';
    return [
        'type' => 'enum('.join(',', array_map(function ($key) {
            return "'$key'";
        }, array_keys(index()))).')',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ];
}
