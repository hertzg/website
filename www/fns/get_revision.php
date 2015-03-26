<?php

function get_revision ($key) {
    static $revisions = [
        'css/calendarIcon/compressed.css' => 2,
        'css/common/compressed.css' => 83,
        'css/confirmDialog/compressed.css' => 1,
        'css/contact/compressed.css' => 3,
        'css/icons/compressed.css' => 69,
        'css/index/compressed.css' => 1,
        'js/batteryAndClock/compressed.js' => 7,
        'js/calendarIcon/compressed.js' => 2,
        'js/confirmDialog/compressed.js' => 5,
        'js/flexTextarea/compressed.js' => 1,
        'js/formCheckbox/compressed.js' => 1,
        'js/geolocationDialog/compressed.js' => 6,
        'js/imageProgress/compressed.js' => 4,
        'js/lineSizeRounding/compressed.js' => 2,
        'js/removeRecipient/compressed.js' => 1,
        'js/searchForm/compressed.js' => 2,
        'js/signOutConfirm/compressed.js' => 2,
        'js/timezoneLabel/compressed.js' => 6,
        'js/unloadProgress/compressed.js' => 6,
        'themes/blue/images/zvini.svg' => 3,
        'themes/green/images/zvini.svg' => 3,
        'themes/orange/images/zvini.svg' => 3,
        'themes/pink/images/zvini.svg' => 3,
        'zvini-icons/16.png' => 1,
        'zvini-icons/32.png' => 1,
    ];
    return $revisions[$key];
}
