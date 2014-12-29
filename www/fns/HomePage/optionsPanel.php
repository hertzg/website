<?php

namespace HomePage;

function optionsPanel () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $accountLink = \Page\imageArrowLink('Account',
        '../account/', 'account', ['id' => 'account']);

    $customizeHomeLink = \Page\imageArrowLink('Customize Home',
        'customize/', 'edit-home', ['id' => 'customize']);

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\twoColumns($accountLink, $customizeHomeLink)
        .'<div class="hr"></div>'
        .\Page\imageArrowLink('Help', '../help/', 'help', ['id' => 'help']);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
