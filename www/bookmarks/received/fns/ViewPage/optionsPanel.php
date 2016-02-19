<?php

namespace ViewPage;

function optionsPanel ($receivedBookmark) {

    $bookmarksDir = __DIR__.'/../../..';
    $fnsDir = "$bookmarksDir/../fns";

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $itemQuery = \ItemList\Received\escapedItemQuery($receivedBookmark->id);

    include_once "$bookmarksDir/fns/create_open_links.php";
    $values = create_open_links($receivedBookmark->url, '../../../');
    list($openLink, $openInNewTabLink) = $values;

    include_once "$fnsDir/Page/imageLink.php";
    $importLink = \Page\imageLink('Import',
        "../submit-import.php$itemQuery", 'import-bookmark');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editAndImportLink = \Page\imageArrowLink('Edit and Import',
        "../edit-and-import/$itemQuery", 'import-bookmark',
        ['id' => 'edit-and-import']);

    if ($receivedBookmark->archived) {
        $href = "../submit-unarchive.php$itemQuery";
        $archiveLink = \Page\imageLink('Unarchive', $href, 'unarchive');
    } else {
        $href = "../submit-archive.php$itemQuery";
        $archiveLink = \Page\imageLink('Archive', $href, 'archive');
    }

    $deleteLink = \Page\imageLink('Delete',
        "../delete/$itemQuery", 'trash-bin', ['id' => 'delete']);

    include_once __DIR__.'/../../../fns/send_via_sms_link.php';
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\twoColumns($openLink, $openInNewTabLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .send_via_sms_link($receivedBookmark)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Bookmark Options', $content);

}
