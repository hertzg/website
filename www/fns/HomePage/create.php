<?php

namespace HomePage;

function create ($mysqli, $user, &$head, &$scripts) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .= compressed_js_script('searchForm', '../');

    include_once "$fnsDir/SearchForm/emptyContent.php";
    $formContent = \SearchForm\emptyContent('Search...');

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once __DIR__.'/notificationWarnings.php';
    $notificationWarnings = notificationWarnings($mysqli, $user);
    if ($notificationWarnings) {
        include_once "$fnsDir/Page/warnings.php";
        $pageWarnings = \Page\warnings($notificationWarnings);
    } else {
        $pageWarnings = '';
    }

    include_once __DIR__.'/homeItems.php';
    include_once __DIR__.'/notificationWarnings.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Page/emptyTabs.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/warnings.php";
    include_once "$fnsDir/SearchForm/create.php";
    return
        \Page\emptyTabs(
            \Page\sessionMessages('home/messages')
            .$pageWarnings
            .\SearchForm\create('../search/', $formContent)
            .'<div class="hr"></div>'
            .homeItems($mysqli, $user, $head, $scripts)
        )
        .optionsPanel();

}
