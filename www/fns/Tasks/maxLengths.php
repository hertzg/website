<?php

namespace Tasks;

function maxLengths () {
    include_once __DIR__.'/../Tags/maxLength.php';
    return [
        'task_text' => 4096,
        'tags' => \Tags\maxLength(),
    ];
}
