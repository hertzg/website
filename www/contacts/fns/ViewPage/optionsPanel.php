<?php

namespace ViewPage;

function optionsPanel ($contact) {

    $id_contacts = $contact->id_contacts;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id_contacts);

    include_once "$fnsDir/Page/imageArrowLink.php";

    $safe_name = str_replace('/', '_', $contact->full_name);
    $href = "../download/$id_contacts/$safe_name.vcf";
    $downloadLink = \Page\imageArrowLink('Download', $href, 'download');

    $href = "../edit/$escapedItemQuery";
    $editLink = \Page\imageArrowLink('Edit', $href, 'edit-contact');

    $href = "../send/$escapedItemQuery";
    $sendLink = \Page\imageArrowLink('Send', $href, 'send');

    $href = "../delete/$escapedItemQuery";
    $deleteLink = \Page\imageArrowLink('Delete', $href, 'trash-bin');
    $deleteLink = "<div id=\"deleteLink\">$deleteLink</div>";

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content =
        \Page\staticTwoColumns($downloadLink, $editLink)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($sendLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Contact Options', $content);
}
