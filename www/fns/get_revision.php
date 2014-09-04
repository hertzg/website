<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 49,
        'icons.compressed.css' => 52,
    ];
    return $revisions[$key];
}
