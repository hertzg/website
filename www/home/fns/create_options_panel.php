<?php

function create_options_panel () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $accountLink = Page\imageArrowLink('Account', '../account/', 'account');

    $title = 'Customize Home';
    $customizeHomeLink = Page\imageArrowLink($title, 'customize/', 'edit-home');

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($accountLink, $customizeHomeLink)
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Help', '../help/', 'help');

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
