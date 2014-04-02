<?php

function create_options_panel ($id) {

    $options = [];

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';

    $href = "submit-import.php?id=$id";
    $options[] = Page\imageArrowLink('Import', $href, 'import-contact');

    $href = "../delete/?id=$id";
    $options[] = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Contact Options', join('<div class="hr"></div>', $options));

}
