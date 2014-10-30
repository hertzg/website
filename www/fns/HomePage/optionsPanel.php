<?php

namespace HomePage;

function optionsPanel () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $accountLink = \Page\imageArrowLink('Account', '../account/', 'account');

    $customizeHomeLink = \Page\imageArrowLink(
        'Customize Home', 'customize/', 'edit-home');

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\twoColumns($accountLink, $customizeHomeLink)
        .'<div class="hr"></div>'
        .\Page\imageArrowLink('Help', '../help/', 'help');

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
