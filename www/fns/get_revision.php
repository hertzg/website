<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 41,
        'icons.compressed.css' => 47,
    ];
    return $revisions[$key];
}
