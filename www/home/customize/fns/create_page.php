<?php

function create_page ($base = '') {

    $fnsPageDir = __DIR__.'/../../../fns/Page';

    include_once "$fnsPageDir/imageArrowLink.php";
    include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
    include_once "$fnsPageDir/sessionMessages.php";
    include_once "$fnsPageDir/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => "$base..",
            ],
        ],
        'Customize',
        Page\sessionMessages('home/customize/messages')
        .Page\imageArrowLinkWithDescription('Show / Hide Items',
            'Change the visibility of the items.', "{$base}show-hide/",
            'show-hide')
        .'<div class="hr"></div>'
        .Page\imageArrowLinkWithDescription('Reorder Items',
            'Change the order in which the items appear.',
            "{$base}reorder/", 'reorder')
        .'<div class="hr"></div>'
        .'<div id="restoreLink">'
            .Page\imageArrowLink('Restore Defaults',
                "{$base}restore-defaults/", 'restore-defaults')
        .'</div>'
    );

}
