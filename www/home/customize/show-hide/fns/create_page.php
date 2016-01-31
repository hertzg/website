<?php

function create_page ($user, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('formCheckbox', "$base../../../");

    include_once __DIR__.'/get_home_items.php';
    $homeItems = get_home_items();

    include_once __DIR__.'/../../fns/get_user_home_items.php';
    $userHomeItems = get_user_home_items($homeItems, $user);

    include_once "$fnsDir/Form/checkboxItem.php";
    $items = [];
    foreach ($userHomeItems as $key => $item) {
        if ($key === 'admin' && !$user->admin) continue;
        list($title, $propertyPart) = $item;
        $userProperty = "show_$propertyPart";
        $checked = $user->$userProperty;
        $items[] = Form\checkboxItem($propertyPart, $title, $checked);
    }

    include_once "$fnsDir/Form/button.php";
    $items[] = Form\button('Save Changes');

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/text.php";
    return
        Page\create(
            [
                'title' => 'Customize',
                'href' => "$base../#show-hide",
            ],
            'Show / Hide Items',
            Page\sessionMessages('home/customize/show-hide/messages')
            .Page\text('Select the items you want to see on your home page:')
            ."<form action=\"{$base}submit.php\" method=\"post\">"
                .join('<div class="hr"></div>', $items)
            .'</form>'
        )
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
        );

}
