<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 31,
        'icons.css' => 33,
        'images/icons.svg' => 40,
    ];
    return $revisions[$key];
}
