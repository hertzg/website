<?php

function create_options_panel ($id) {

    $options = [];

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';
    $href = "../delete/?id=$id";
    $options[] = Page\imageArrowLink('Delete Contact', $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
