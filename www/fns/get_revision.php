<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 23,
        'icons.css' => 24,
        'images/icons.png' => 28,
    ];
    return $revisions[$key];
}
