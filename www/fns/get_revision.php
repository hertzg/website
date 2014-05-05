<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 38,
        'icons.compressed.css' => 41,
    ];
    return $revisions[$key];
}
