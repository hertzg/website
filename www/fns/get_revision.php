<?php

function get_revision ($key) {
    static $revisions = [
        'common.compressed.css' => 56,
        'contact.compressed.css' => 1,
        'icons.compressed.css' => 56,
        'js/confirmDialog.js' => 1,
    ];
    return $revisions[$key];
}
