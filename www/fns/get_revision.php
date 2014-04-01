<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 21,
        'icons.css' => 23,
    ];
    return $revisions[$key];
}
