<?php

namespace HomePage;

function create ($mysqli, $user, &$head, &$scripts) {

    $base = '../';
    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .= compressed_js_script('searchForm', '../');

    include_once "$fnsDir/SearchForm/emptyContent.php";
    $formContent = \SearchForm\emptyContent('Search...');

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('calendarIcon', $base);

    include_once __DIR__.'/getHomeItems.php';
    include_once __DIR__.'/newNotifications.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Page/emptyTabs.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/SearchForm/create.php";
    return
        \Page\emptyTabs(
            \Page\sessionMessages('home/messages')
            .newNotifications($mysqli, $user)
            .\SearchForm\create('../search/', $formContent)
            .'<div class="hr"></div>'
            .getHomeItems($mysqli, $user, $scripts)
        )
        .optionsPanel();

}
