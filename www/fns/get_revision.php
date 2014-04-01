<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 18,
        'icons.css' => 21,
    ];
    return $revisions[$key];
}
