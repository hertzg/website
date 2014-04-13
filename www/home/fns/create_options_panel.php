<?php

function create_options_panel () {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

    $accountLink = Page\imageArrowLink('Account', '../account/', 'account');

    $title = 'Customize Home';
    $customizeHomeLink = Page\imageArrowLink($title, 'customize/', 'edit-home');

    $helpLink = Page\imageArrowLink('Help', '../help/', 'help');

    $href = '../submit-signout.php';
    $signOutLink = Page\imageLink('Sign Out', $href, 'sign-out');

    include_once __DIR__.'/../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($accountLink, $customizeHomeLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($helpLink, $signOutLink);

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', $content);

}
