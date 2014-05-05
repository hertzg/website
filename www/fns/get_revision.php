<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 38,
        'icons.compressed.css' => 39,
    ];
    return $revisions[$key];
}
