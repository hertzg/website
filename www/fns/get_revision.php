<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 31,
        'icons.css' => 34,
        'images/icons.svg' => 41,
    ];
    return $revisions[$key];
}
