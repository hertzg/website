<?php

function create_options_panel ($receivedBookmark) {

    $id = $receivedBookmark->id;

    include_once __DIR__.'/../../../fns/create_open_links.php';
    $values = create_open_links($receivedBookmark->url, '../../../');
    list($openLink, $openInNewTabLink) = $values;

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';

    $href = "submit-import.php?id=$id";
    $importLink = Page\imageArrowLink('Import', $href, 'import-bookmark');

    $href = "../edit-and-import/?id=$id";
    $icon = 'import-bookmark';
    $editAndImportLink = Page\imageArrowLink('Edit and Import', $href, $icon);

    $href = "../delete/?id=$id";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($openLink, $openInNewTabLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Bookmark Options', $content);

}
