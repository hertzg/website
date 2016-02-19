<?php

namespace ViewPage;

function optionsPanel ($receivedCalculation) {

    $calculationsDir = __DIR__.'/../../..';
    $fnsDir = "$calculationsDir/../fns";

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $itemQuery = \ItemList\Received\escapedItemQuery($receivedCalculation->id);

    include_once "$fnsDir/Page/imageLink.php";
    $importLink = \Page\imageLink('Import',
        "../submit-import.php$itemQuery", 'import-calculation');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editAndImportLink = \Page\imageArrowLink('Edit and Import',
        "../edit-and-import/$itemQuery", 'import-calculation',
        ['id' => 'edit-and-import']);

    if ($receivedCalculation->archived) {
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
        \Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .send_via_sms_link($receivedCalculation,
            $receivedCalculation->expression)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Calculation Options', $content);

}
