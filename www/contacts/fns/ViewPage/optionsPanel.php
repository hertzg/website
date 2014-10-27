<?php

namespace ViewPage;

function optionsPanel ($contact, $base) {

    $id = $contact->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $safe_name = str_replace('/', '_', $contact->full_name);
    $href = "$base../download/$id/$safe_name.vcf";
    $downloadLink = \Page\imageLink('Download', $href, 'download');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "$base../edit/$escapedItemQuery";
    $editLink = \Page\imageArrowLink('Edit', $href, 'edit-contact');

    $href = "$base../send/$escapedItemQuery";
    $sendLink = \Page\imageArrowLink('Send', $href, 'send');

    include_once __DIR__.'/../contact_sms_text.php';
    $href = 'sms:?body='.rawurlencode(contact_sms_text($contact));
    $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    $href = "$base../delete/$escapedItemQuery";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\staticTwoColumns($downloadLink, $editLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendLink, $sendViaSmsLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once "$fnsDir/create_panel.php";
    return create_panel('Contact Options', $content);
}
