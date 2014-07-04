<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 46,
        'icons.compressed.css' => 51,
    ];
    return $revisions[$key];
}
