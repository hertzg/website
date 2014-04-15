<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 29,
        'icons.css' => 29,
        'images/icons.svg' => 36,
    ];
    return $revisions[$key];
}
