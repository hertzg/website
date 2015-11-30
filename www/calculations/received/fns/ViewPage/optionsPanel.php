<?php

namespace ViewPage;

function optionsPanel ($receivedCalculation) {

    $calculationsDir = __DIR__.'/../../..';
    $fnsDir = "$calculationsDir/../fns";

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $itemQuery = \ItemList\Received\escapedItemQuery($receivedCalculation->id);

    include_once "$calculationsDir/fns/create_open_links.php";
    $values = create_open_links($receivedCalculation->url, '../../../');
    list($openLink, $openInNewTabLink) = $values;

    include_once "$fnsDir/Page/imageLink.php";
    $importLink = \Page\imageLink('Import',
        "../submit-import.php$itemQuery", 'import-calculation');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editAndImportLink = \Page\imageArrowLink('Edit and Import',
        "../edit-and-import/$itemQuery", 'import-calculation',
        ['id' => 'edit-and-import']);

    include_once "$fnsDir/Page/imageLink.php";
    $href = 'sms:?body='.rawurlencode($receivedCalculation->url);
    $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    if ($receivedCalculation->archived) {
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
    return create_panel('Calculation Options', $content);

}
