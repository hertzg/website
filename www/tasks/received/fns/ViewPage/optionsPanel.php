<?php

namespace ViewPage;

function optionsPanel ($receivedTask) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $itemQuery = \ItemList\Received\escapedItemQuery($receivedTask->id);

    include_once "$fnsDir/Page/imageLink.php";
    $href = "../submit-import.php$itemQuery";
    $importLink = \Page\imageLink('Import', $href, 'import-task');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $title = 'Edit and Import';
    $href = "../edit-and-import/$itemQuery";
    $editAndImportLink = \Page\imageArrowLink($title, $href, 'import-task');

    if ($receivedTask->archived) {
        $href = "../submit-unarchive.php$itemQuery";
        $archiveLink = \Page\imageLink('Unarchive', $href, 'unarchive');
    } else {
        $href = "../submit-archive.php$itemQuery";
        $archiveLink = \Page\imageLink('Archive', $href, 'archive');
    }

    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', "../delete/$itemQuery", 'trash-bin')
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
