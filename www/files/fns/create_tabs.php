<?php

function create_tabs ($user, $base = '') {

    $num_received = $user->num_received_files + $user->num_received_folders;
    if (!$num_received) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/create_my_tab_content.php';
    include_once __DIR__.'/create_received_tab_content.php';
    include_once "$fnsDir/Page/Tabs/create.php";
    include_once "$fnsDir/Page/Tabs/normalTab.php";
    include_once "$fnsDir/Page/Tabs/selectedTab.php";
    return Page\Tabs\create(
        Page\Tabs\selectedTab(create_my_tab_content($user)),
        Page\Tabs\normalTab(
            create_received_tab_content($user), "{$base}received/")
    );

}
