<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 55,
        'contact.compressed.css' => 1,
        'icons.compressed.css' => 54,
    ];
    return $revisions[$key];
}
