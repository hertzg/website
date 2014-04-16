<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 29,
        'icons.css' => 31,
        'images/icons.svg' => 38,
    ];
    return $revisions[$key];
}
