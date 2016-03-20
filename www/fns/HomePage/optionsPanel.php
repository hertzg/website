<?php

namespace HomePage;

function optionsPanel () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $accountLink = \Page\imageArrowLink('Account',
        '../account/', 'account', ['id' => 'account']);

    $customizeHomeLink = \Page\imageArrowLink(
        'Customize Home', 'customize/', 'edit-home',
        [
            'id' => 'customize',
            'localNavigation' => true,
        ]
    );

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\twoColumns($accountLink, $customizeHomeLink)
        .'<div class="hr"></div>'
        .\Page\imageArrowLink('Help', '../help/', 'help', [
            'id' => 'help',
            'localNavigation' => true,
        ]);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Options', $content);

}
