<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 25,
        'icons.css' => 25,
        'images/icons.png' => 30,
    ];
    return $revisions[$key];
}
