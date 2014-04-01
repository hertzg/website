<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 19,
        'icons.css' => 22,
    ];
    return $revisions[$key];
}
