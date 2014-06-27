<?php

function create_options_panel ($receivedContact) {

    $fnsDir = __DIR__.'/../../../../fns';

    $itemQuery = "?id=$receivedContact->id";

    include_once "$fnsDir/Page/imageLink.php";
    $href = "submit-import.php$itemQuery";
    $importLink = Page\imageLink('Import', $href, 'import-contact');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../edit-and-import/$itemQuery";
    $icon = 'import-contact';
    $editAndImportLink = Page\imageArrowLink('Edit and Import', $href, $icon);

    include_once "$fnsDir/Page/imageLink.php";
    if ($receivedContact->archived) {
        $archiveLink = Page\imageLink('Unarchive',
            "submit-unarchive.php$itemQuery", 'unarchive');
    } else {
        $archiveLink = Page\imageLink('Archive',
            "submit-archive.php$itemQuery", 'archive');
    }

    $href = "../delete/$itemQuery";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Contact Options', $content);

}
