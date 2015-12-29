<?php

function create_content ($user, $total, $filterMessage, $items, $base) {

    $fnsDir = __DIR__.'/../../fns';

    $num_received_calculations = $user->num_received_calculations;
    if ($num_received_calculations) {
        include_once __DIR__.'/create_my_tab_content.php';
        include_once __DIR__.'/create_received_tab_content.php';
        include_once "$fnsDir/Page/Tabs/create.php";
        include_once "$fnsDir/Page/Tabs/normalTab.php";
        include_once "$fnsDir/Page/Tabs/selectedTab.php";
        $tabs = Page\Tabs\create(
            Page\Tabs\selectedTab(create_my_tab_content($user)),
            Page\Tabs\normalTab(
                create_received_tab_content($user), "{$base}received/")
        );
    } else {
        $tabs = '';
    }

    include_once __DIR__.'/create_options_panel.php';
    include_once __DIR__.'/sort_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Home',
                'href' => "$base../home/#calculations",
            ],
            'Calculations',
            $tabs.Page\sessionErrors('calculations/errors')
            .Page\sessionMessages('calculations/messages')
            .$filterMessage.join('<div class="hr"></div>', $items),
            create_new_item_button('Calculation',
                $base, !$user->num_calculations)
        )
        .sort_panel($user, $total, $base)
        .create_options_panel($user, $base);

}
