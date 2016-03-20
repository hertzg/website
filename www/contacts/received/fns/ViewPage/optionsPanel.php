<?php

namespace ViewPage;

function optionsPanel ($receivedContact) {

    $id = $receivedContact->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $itemQuery = \ItemList\Received\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $safe_name = str_replace('/', '_', $receivedContact->full_name);
    $href = "../download/$id/$safe_name.vcf";
    $downloadLink = \Page\imageLink('Download', $href, 'download');

    $href = "../submit-import.php$itemQuery";
    $importLink = \Page\imageLink('Import', $href, 'import-contact');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editAndImportLink = \Page\imageArrowLink('Edit and Import',
        "../edit-and-import/$itemQuery", 'import-contact',
        ['id' => 'edit-and-import']);

    if ($receivedContact->archived) {
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
        $downloadLink
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .send_via_sms_link($receivedContact)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Contact Options', $content);

}
