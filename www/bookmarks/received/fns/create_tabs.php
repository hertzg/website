<?php

function create_tabs ($user) {

    $fnsDir = __DIR__.'/../../../fns';
    $num_bookmarks = $user->num_bookmarks;

    if ($num_bookmarks) {
        include_once "$fnsDir/title_and_description.php";
        $my_content = title_and_description('My', "$num_bookmarks total.");
    } else {
        $my_content = 'My';
    }

    include_once __DIR__.'/../../fns/create_my_tab_content.php';
    include_once __DIR__.'/../../fns/create_received_tab_content.php';
    include_once "$fnsDir/Page/Tabs/create.php";
    include_once "$fnsDir/Page/Tabs/normalTab.php";
    include_once "$fnsDir/Page/Tabs/selectedTab.php";
    return Page\Tabs\create(
        Page\Tabs\normalTab(create_my_tab_content($user), '../'),
        Page\Tabs\selectedTab(create_received_tab_content($user))
    );

}
