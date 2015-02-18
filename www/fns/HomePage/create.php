<?php

namespace HomePage;

function create ($mysqli, $user, &$head, &$scripts) {

    $fnsDir = __DIR__.'/..';

    $items = [];

    include_once "$fnsDir/SearchForm/emptyContent.php";
    $formContent = \SearchForm\emptyContent('Search...');

    include_once "$fnsDir/SearchForm/create.php";
    $items[] = \SearchForm\create('../search/', $formContent);

    include_once __DIR__.'/getHomeItems.php';
    $homeItems = getHomeItems($mysqli, $user, $scripts);

    $items = array_merge($items, $homeItems);

    $groupedItems = [];
    if (count($items) % 2) $groupedItems[] = array_shift($items);
    include_once "$fnsDir/Page/twoColumns.php";
    foreach (array_chunk($items, 2) as $item) {
        $groupedItems[] = \Page\twoColumns($item[0], $item[1]);
    }

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    $head = '<link rel="stylesheet" type="text/css" href="../home.css" />';

    include_once __DIR__.'/newNotifications.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/compressed_js_script.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [],
            'Home',
            \Page\sessionMessages('home/messages')
            .newNotifications($mysqli, $user)
            .join('<div class="hr"></div>', $groupedItems)
        )
        .optionsPanel()
        .compressed_js_script('searchForm', '../');

}
