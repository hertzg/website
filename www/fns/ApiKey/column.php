<?php

namespace ApiKey;

function column ($nullable = false) {
    include_once __DIR__.'/length.php';
    return [
        'type' => 'binary('.length().')',
        'nullable' => $nullable,
    ];
}
