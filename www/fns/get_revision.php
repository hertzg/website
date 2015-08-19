<?php

function get_revision ($key) {
    static $revisions = [
        'css/barChart/compressed.css' => 6,
        'css/calendarIcon/compressed.css' => 3,
        'css/common/compressed.css' => 106,
        'css/confirmDialog/compressed.css' => 2,
        'css/contact/compressed.css' => 4,
        'css/iconsets/compressed.css' => 82,
        'css/index/compressed.css' => 2,
        'css/newItemMenu/compressed.css' => 4,
        'images/icons/16.png' => 1,
        'images/icons/32.png' => 1,
        'js/batteryAndClock/compressed.js' => 9,
        'js/calendarIcon/compressed.js' => 3,
        'js/confirmDialog/compressed.js' => 5,
        'js/dateAgo/compressed.js' => 2,
        'js/flexTextarea/compressed.js' => 1,
        'js/formCheckbox/compressed.js' => 1,
        'js/geolocationDialog/compressed.js' => 6,
        'js/imageProgress/compressed.js' => 4,
        'js/lineSizeRounding/compressed.js' => 4,
        'js/removeRecipient/compressed.js' => 1,
        'js/searchForm/compressed.js' => 2,
        'js/sessionTimeout/compressed.js' => 2,
        'js/signOutConfirm/compressed.js' => 3,
        'js/timezoneLabel/compressed.js' => 6,
        'js/unloadProgress/compressed.js' => 8,
        'theme/color/blue/images/zvini.svg' => 3,
        'theme/color/green/images/zvini.svg' => 3,
        'theme/color/orange/images/zvini.svg' => 3,
        'theme/color/pink/images/zvini.svg' => 3,
    ];
    return $revisions[$key];
}
