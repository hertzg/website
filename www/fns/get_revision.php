<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 29,
        'icons.css' => 30,
        'images/icons.svg' => 37,
    ];
    return $revisions[$key];
}
