<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 39,
        'icons.compressed.css' => 44,
    ];
    return $revisions[$key];
}
