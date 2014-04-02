<?php

function create_options_panel ($id) {

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';

    $href = "submit-import.php?id=$id";
    $importLink = Page\imageArrowLink('Import', $href, 'import-note');

    $href = "../delete/?id=$id";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/Page/twoColumns.php';
    $content = Page\twoColumns($importLink, $deleteLink);

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Note Options', $content);

}
