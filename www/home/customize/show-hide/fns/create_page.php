<?php

function create_page ($user, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once __DIR__.'/get_home_items.php';
    $homeItems = get_home_items();

    include_once __DIR__.'/../../fns/get_user_home_items.php';
    $userHomeItems = get_user_home_items($homeItems, $user);

    include_once "$fnsDir/Form/checkboxItem.php";
    $items = [];
    foreach ($userHomeItems as $key => $item) {
        list($title, $propertyPart) = $item;
        $userProperty = "show_$propertyPart";
        $checked = $user->$userProperty;
        $items[] = Form\checkboxItem($propertyPart, $title, $checked);
    }

    include_once "$fnsDir/Form/button.php";
    $items[] = Form\button('Save Changes');

    include_once "$fnsDir/compressed_js_script.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/warnings.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Customize',
                    'href' => "$base../#show_hide",
                ],
            ],
            'Show / Hide Items',
            Page\sessionMessages('home/customize/show-hide/messages')
            .Page\warnings(['Select items to see them on your home page.'])
            ."<form action=\"{$base}submit.php\" method=\"post\">"
                .join('<div class="hr"></div>', $items)
            .'</form>'
            .create_panel(
                'Options',
                Page\imageLinkWithDescription('Reorder Items',
                    'Change the order in which the items appear.',
                    "$base../reorder/", 'reorder')
                .'<div class="hr"></div>'
                .'<div id="restoreLink">'
                    .Page\imageLink('Restore Defaults',
                        "{$base}restore-defaults/", 'restore-defaults')
                .'</div>'
            )
        )
        .compressed_js_script('formCheckbox', "$base../../../");

}
