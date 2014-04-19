<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 30,
        'icons.css' => 33,
        'images/icons.svg' => 40,
    ];
    return $revisions[$key];
}
