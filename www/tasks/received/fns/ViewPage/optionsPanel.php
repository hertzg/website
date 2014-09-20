<?php

namespace ViewPage;

function optionsPanel ($receivedTask) {

    $fnsDir = __DIR__.'/../../../../fns';

    $itemQuery = "?id=$receivedTask->id";

    include_once "$fnsDir/Page/imageLink.php";
    $href = "submit-import.php$itemQuery";
    $importLink = \Page\imageLink('Import', $href, 'import-task');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../edit-and-import/$itemQuery";
    $icon = 'import-task';
    $editAndImportLink = \Page\imageArrowLink('Edit and Import', $href, $icon);

    include_once "$fnsDir/Page/imageLink.php";
    if ($receivedTask->archived) {
        $archiveLink = \Page\imageLink('Unarchive',
            "submit-unarchive.php$itemQuery", 'unarchive');
    } else {
        $archiveLink = \Page\imageLink('Archive',
            "submit-archive.php$itemQuery", 'archive');
    }

    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageArrowLink('Delete', "../delete/$itemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Task Options', $content);

}
