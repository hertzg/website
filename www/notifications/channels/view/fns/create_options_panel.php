<?php

function create_options_panel ($id) {

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';

    $options = [];

    $title = 'Randomize Channel Key';
    $href = "../randomize-key/?id=$id";
    $options[] = Page\imageArrowLink($title, $href, 'randomize');

    $title = 'Channel Users';
    $href = "../users/?id=$id";
    $options[] = Page\imageArrowLink($title, $href, 'users');

    $title = 'Delete Channel';
    $href = "../delete/?id=$id";
    $options[] = Page\imageArrowLink($title, $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
