<?php

function create_options_panel ($receivedTask) {

    $fnsDir = __DIR__.'/../../../../fns';

    $itemQuery = "?id=$receivedTask->id";

    include_once "$fnsDir/Page/imageArrowLink.php";

    $href = "submit-import.php$itemQuery";
    $importLink = Page\imageArrowLink('Import', $href, 'import-task');

    $href = "../edit-and-import/$itemQuery";
    $icon = 'import-task';
    $editAndImportLink = Page\imageArrowLink('Edit and Import', $href, $icon);

    include_once "$fnsDir/Page/imageLink.php";
    if ($receivedTask->archived) {
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
    return create_panel('Task Options', $content);

}
