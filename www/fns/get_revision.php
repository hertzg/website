<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 45,
        'icons.compressed.css' => 51,
    ];
    return $revisions[$key];
}
