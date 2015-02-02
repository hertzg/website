<?php

function get_revision ($key) {
    static $revisions = [
        'css/common/compressed.css' => 82,
        'css/confirmDialog/compressed.css' => 1,
        'css/contact/compressed.css' => 2,
        'css/icons/compressed.css' => 63,
        'css/index/compressed.css' => 1,
        'js/batteryAndClock/compressed.js' => 3,
        'js/confirmDialog/compressed.js' => 5,
        'js/flexTextarea/compressed.js' => 1,
        'js/formCheckbox/compressed.js' => 1,
        'js/imageProgress/compressed.js' => 3,
        'js/lineSizeRounding/compressed.js' => 2,
        'js/removeRecipient/compressed.js' => 1,
        'js/searchForm/compressed.js' => 2,
        'js/signOutConfirm/compressed.js' => 2,
        'js/timezoneLabel/compressed.js' => 3,
        'js/unloadProgress/compressed.js' => 5,
        'themes/blue/images/zvini.svg' => 2,
        'themes/green/images/zvini.svg' => 2,
        'themes/orange/images/zvini.svg' => 2,
        'themes/pink/images/zvini.svg' => 2,
    ];
    return $revisions[$key];
}
