<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 37,
        'icons.compressed.css' => 36,
        'images/icons.svg' => 43,
    ];
    return $revisions[$key];
}
