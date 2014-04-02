<?php

function create_options_panel ($id) {

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';

    $title = 'Randomize Key';
    $href = "../randomize-key/?id=$id";
    $randomizeKeyLink = Page\imageArrowLink($title, $href, 'randomize');

    $title = 'Users';
    $href = "../users/?id=$id";
    $usersLink = Page\imageArrowLink($title, $href, 'users');

    $title = 'Delete';
    $href = "../delete/?id=$id";
    $deleteLink = Page\imageArrowLink($title, $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($randomizeKeyLink, $usersLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Channel Options', $content);

}
