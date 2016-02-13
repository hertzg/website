<?php

function create_page (&$head, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('confirmDialog', "$base../../");

    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return Page\create(
        [
            'title' => 'Home',
            'href' => "$base../#customize",
            'localNavigation' => true,
        ],
        'Customize',
        Page\sessionMessages('home/customize/messages')
        .Page\imageArrowLinkWithDescription('Show / Hide Items',
            'Change the visibility of the items.',
            "{$base}show-hide/", 'show-hide', [
                'id' => 'show-hide',
                'localNavigation' => true,
            ]
        )
        .'<div class="hr"></div>'
        .Page\imageArrowLinkWithDescription('Reorder Items',
            'Change the order in which the items appear.',
            "{$base}reorder/", 'reorder', [
                'id' => 'reorder',
                'localNavigation' => true,
            ]
        )
        .'<div class="hr"></div>'
        .'<div id="restoreLink">'
            .Page\imageLink('Restore Defaults',
                "{$base}restore-defaults/", 'restore-defaults')
        .'</div>'
    );

}
