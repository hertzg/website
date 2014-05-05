<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 38,
        'icons.compressed.css' => 43,
    ];
    return $revisions[$key];
}
