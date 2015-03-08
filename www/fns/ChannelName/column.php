<?php

namespace ChannelName;

function column () {
    include_once __DIR__.'/maxLength.php';
    return [
        'type' => 'varchar('.maxLength().')',
        'characterSet' => 'ascii',
        'collation' => 'ascii_general_ci',
    ];
}
