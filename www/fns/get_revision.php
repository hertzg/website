<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 41,
        'icons.compressed.css' => 48,
    ];
    return $revisions[$key];
}
