<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 23,
        'icons.css' => 23,
        'images/icons.png' => 26,
    ];
    return $revisions[$key];
}
