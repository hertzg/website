<?php

function get_revision ($key) {
    static $revisions = [
        'css/barChart/compressed.css' => 7,
        'css/calendarIcon/compressed.css' => 3,
        'css/common/compressed.css' => 147,
        'css/confirmDialog/compressed.css' => 5,
        'css/contact/compressed.css' => 5,
        'css/iconsets/compressed.css' => 99,
        'css/index/compressed.css' => 7,
        'images/icons/16.png' => 2,
        'images/icons/32.png' => 2,
        'js/batteryAndClock/compressed.js' => 12,
        'js/calendarIcon/compressed.js' => 3,
        'js/confirmDialog/compressed.js' => 5,
        'js/dateAgo/compressed.js' => 2,
        'js/dateField/compressed.js' => 1,
        'js/flexTextarea/compressed.js' => 2,
        'js/formCheckbox/compressed.js' => 2,
        'js/geolocationDialog/compressed.js' => 6,
        'js/imageProgress/compressed.js' => 4,
        'js/lineSizeRounding/compressed.js' => 4,
        'js/removeRecipient/compressed.js' => 1,
        'js/searchForm/compressed.js' => 2,
        'js/sessionTimeout/compressed.js' => 4,
        'js/signOutConfirm/compressed.js' => 3,
        'js/timezoneLabel/compressed.js' => 6,
        'js/unloadProgress/compressed.js' => 9,
        'theme/color/blue/images/zvini.svg' => 6,
        'theme/color/cyan/images/zvini.svg' => 4,
        'theme/color/lime/images/zvini.svg' => 6,
        'theme/color/orange/images/zvini.svg' => 6,
        'theme/color/pink/images/zvini.svg' => 6,
    ];
    return $revisions[$key];
}
