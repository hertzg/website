<?php

function create_options_panel ($receivedTask) {

    $queryString = "?id=$receivedTask->id";

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';

    $href = "submit-import.php$queryString";
    $importLink = Page\imageArrowLink('Import', $href, 'import-task');

    $href = "../edit-and-import/$queryString";
    $icon = 'import-task';
    $editAndImportLink = Page\imageArrowLink('Edit and Import', $href, $icon);

    $href = "../delete/$queryString";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/Page/imageLink.php';
    if ($receivedTask->archived) {
        $archiveLink = Page\imageLink('Unarchive',
            "submit-unarchive.php$queryString", 'TODO');
    } else {
        $archiveLink = Page\imageLink('Archive',
            "submit-archive.php$queryString", 'TODO');
    }

    include_once __DIR__.'/../../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($archiveLink, $deleteLink);

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Task Options', $content);

}
