<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 38,
        'icons.compressed.css' => 38,
        'images/icons.svg' => 46,
    ];
    return $revisions[$key];
}
