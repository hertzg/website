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
    $href = "../submit-import.php$itemQuery";
    $importLink = \Page\imageLink('Import', $href, 'import-bookmark');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../edit-and-import/$itemQuery";
    $icon = 'import-bookmark';
    $editAndImportLink = \Page\imageArrowLink('Edit and Import', $href, $icon);

    include_once "$fnsDir/Page/imageLink.php";
    $href = 'sms:?body='.rawurlencode($receivedBookmark->url);
    $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    if ($receivedBookmark->archived) {
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
        \Page\twoColumns($openLink, $openInNewTabLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .$sendViaSmsLink
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Bookmark Options', $content);

}
