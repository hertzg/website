<?php

namespace Bookmarks;

function maxLengths () {
    include_once __DIR__.'/../Tags/maxLength.php';
    return [
        'tags' => \Tags\maxLength(),
        'title' => 128,
        'url' => 2048,
    ];
}
