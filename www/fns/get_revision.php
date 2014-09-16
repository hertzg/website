<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 54,
        'contact.compressed.css' => 1,
        'icons.compressed.css' => 53,
    ];
    return $revisions[$key];
}
