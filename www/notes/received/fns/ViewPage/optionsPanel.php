<?php

namespace ViewPage;

function optionsPanel ($receivedNote) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $itemQuery = \ItemList\Received\escapedItemQuery($receivedNote->id);

    include_once "$fnsDir/Page/imageLink.php";
    $importLink = \Page\imageLink('Import',
        "../submit-import.php$itemQuery", 'import-note');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editAndImportLink = \Page\imageArrowLink('Edit and Import',
        "../edit-and-import/$itemQuery", 'import-note',
        ['id' => 'edit-and-import']);

    $href = 'sms:?body='.rawurlencode($receivedNote->text);
    $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    if ($receivedNote->archived) {
        $href = "../submit-unarchive.php$itemQuery";
        $archiveLink = \Page\imageLink('Unarchive', $href, 'unarchive');
    } else {
        $href = "../submit-archive.php$itemQuery";
        $archiveLink = \Page\imageLink('Archive', $href, 'archive');
    }

    $deleteLink = \Page\imageLink('Delete',
        "../delete/$itemQuery", 'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .$sendViaSmsLink
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Note Options', $content);

}
