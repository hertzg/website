<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 43,
        'icons.compressed.css' => 50,
    ];
    return $revisions[$key];
}
