<?php

namespace UserAgent;

function column () {
    return [
        'type' => 'varchar(1024)',
        'nullable' => true,
        'characterSet' => 'ascii',
        'collation' => 'ascii_general_ci',
    ];
}
