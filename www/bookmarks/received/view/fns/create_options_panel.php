<?php

function create_options_panel ($receivedBookmark) {

    $queryString = "?id=$receivedBookmark->id";

    include_once __DIR__.'/../../../fns/create_open_links.php';
    $values = create_open_links($receivedBookmark->url, '../../../');
    list($openLink, $openInNewTabLink) = $values;

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';

    $href = "submit-import.php$queryString";
    $importLink = Page\imageArrowLink('Import', $href, 'import-bookmark');

    $href = "../edit-and-import/$queryString";
    $icon = 'import-bookmark';
    $editAndImportLink = Page\imageArrowLink('Edit and Import', $href, $icon);

    include_once __DIR__.'/../../../../fns/Page/imageLink.php';
    if ($receivedBookmark->archived) {
        $archiveLink = Page\imageLink('Unarchive',
            "submit-unarchive.php$queryString", 'TODO');
    } else {
        $archiveLink = Page\imageLink('Archive',
            "submit-archive.php$queryString", 'TODO');
    }

    $href = "../delete/$queryString";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($openLink, $openInNewTabLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($archiveLink, $deleteLink);

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Bookmark Options', $content);

}
