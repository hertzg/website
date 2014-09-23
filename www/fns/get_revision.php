<?php

function get_revision ($key) {
    static $revisions = [
        'css/common/compressed.css' => 56,
        'css/confirmDialog/compressed.css' => 1,
        'css/contact/compressed.css' => 1,
        'css/icons/compressed.css' => 57,
        'js/batteryAndClock/compressed.js' => 1,
        'js/confirmDialog/compressed.js' => 4,
        'js/formCheckbox/compressed.js' => 1,
        'js/timezoneLabel/compressed.js' => 1,
    ];
    return $revisions[$key];
}
