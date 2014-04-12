<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 27,
        'icons.css' => 29,
        'images/icons.png' => 35,
    ];
    return $revisions[$key];
}
