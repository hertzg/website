<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 29,
        'icons.css' => 32,
        'images/icons.svg' => 39,
    ];
    return $revisions[$key];
}
