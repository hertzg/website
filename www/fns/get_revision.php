<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 38,
        'icons.compressed.css' => 37,
        'images/icons.svg' => 45,
    ];
    return $revisions[$key];
}
