<?php

function create_page ($user, &$head, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('confirmDialog', "$base../../../");

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('formCheckbox', "$base../../../");

    include_once __DIR__.'/get_home_items.php';
    $homeItems = get_home_items();

    include_once __DIR__.'/../../fns/get_user_home_items.php';
    $userHomeItems = get_user_home_items($homeItems, $user);

    $content = '';
    include_once "$fnsDir/Form/checkboxItem.php";
    foreach ($userHomeItems as $key => $item) {

        $propertyPart = $item[1];
        $userProperty = "show_$propertyPart";

        $content .=
            Form\checkboxItem($propertyPart, $item[0], $user->$userProperty)
            .'<div class="hr"></div>';

    }

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/button.php";
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
                'localNavigation' => true,
            ],
            'Show / Hide Items',
            Page\sessionMessages('home/customize/show-hide/messages')
            .Page\text('Select the items you want to see on your home page:')
            ."<form action=\"{$base}submit.php\" method=\"post\">"
                .$content.Form\button('Save Changes')
            .'</form>'
        )
        .create_panel(
            'Options',
            Page\imageLinkWithDescription('Reorder Items',
                'Change the order in which the items appear.',
                "$base../reorder/", 'reorder', ['localNavigation' => true])
            .'<div class="hr"></div>'
            .'<div id="restoreLink">'
                .Page\imageLink('Restore Defaults',
                    "{$base}restore-defaults/", 'restore-defaults')
            .'</div>'
        );

}
