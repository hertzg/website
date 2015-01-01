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

    include_once __DIR__.'/../../../fns/contact_sms_text.php';
    $href = 'sms:?body='.rawurlencode(contact_sms_text($receivedContact));
    $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    if ($receivedContact->archived) {
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
        \Page\staticTwoColumns($downloadLink, $importLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($editAndImportLink, $sendViaSmsLink)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Contact Options', $content);

}
