<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 52,
        'contact.compressed.css' => 1,
        'icons.compressed.css' => 52,
    ];
    return $revisions[$key];
}
