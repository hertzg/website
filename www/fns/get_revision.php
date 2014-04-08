<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 27,
        'icons.css' => 28,
        'images/icons.png' => 34,
    ];
    return $revisions[$key];
}
