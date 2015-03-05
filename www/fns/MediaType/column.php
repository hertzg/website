<?php

namespace MediaType;

function column () {
    return [
        'type' => "enum('archive','audio','image','text','unknown','video')",
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ];
}
