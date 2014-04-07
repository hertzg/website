<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 27,
        'icons.css' => 26,
        'images/icons.png' => 31,
    ];
    return $revisions[$key];
}
