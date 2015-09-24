<?php

namespace ApiKey;

function column () {
    include_once __DIR__.'/length.php';
    return ['type' => 'binary('.length().')'];
}
