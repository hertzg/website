<?php

function get_revision ($key) {
    static $revisions = [
        'css/common/compressed.css' => 56,
        'css/confirmDialog/compressed.css' => 1,
        'css/contact/compressed.css' => 1,
        'css/icons/compressed.css' => 57,
        'js/confirmDialog.js' => 2,
    ];
    return $revisions[$key];
}
