<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 29,
        'icons.css' => 33,
        'images/icons.svg' => 40,
    ];
    return $revisions[$key];
}
