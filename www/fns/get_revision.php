<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 40,
        'icons.compressed.css' => 44,
    ];
    return $revisions[$key];
}
