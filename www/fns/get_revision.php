<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 27,
        'icons.css' => 27,
        'images/icons.png' => 32,
    ];
    return $revisions[$key];
}
