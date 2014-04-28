<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 34,
        'icons.css' => 35,
        'images/icons.svg' => 42,
    ];
    return $revisions[$key];
}
