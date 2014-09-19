<?php

function get_revision ($key) {
    static $revisions = [
        'css/common/compressed.css' => 56,
        'css/contact/compressed.css' => 1,
        'icons.compressed.css' => 57,
        'js/confirmDialog.js' => 1,
    ];
    return $revisions[$key];
}
