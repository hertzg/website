<?php

function get_revision ($key) {
    static $revisions = [
        'css/common/compressed.css' => 61,
        'css/confirmDialog/compressed.css' => 1,
        'css/contact/compressed.css' => 2,
        'css/icons/compressed.css' => 57,
        'css/index/compressed.css' => 1,
        'js/batteryAndClock/compressed.js' => 1,
        'js/confirmDialog/compressed.js' => 4,
        'js/formCheckbox/compressed.js' => 1,
        'js/imageProgress/compressed.js' => 2,
        'js/lineSizeRounding/compressed.js' => 2,
        'js/removeRecipient/compressed.js' => 1,
        'js/searchForm/compressed.js' => 2,
        'js/timezoneLabel/compressed.js' => 1,
        'js/unloadProgress/compressed.js' => 4,
    ];
    return $revisions[$key];
}
