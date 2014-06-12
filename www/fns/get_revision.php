<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 40,
        'icons.compressed.css' => 47,
    ];
    return $revisions[$key];
}
