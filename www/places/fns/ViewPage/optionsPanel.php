<?php

namespace ViewPage;

function optionsPanel ($place) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($place->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-place', ['id' => 'edit']);

    $sendLink = \Page\imageArrowLink('Send',
        "../send/$escapedItemQuery", 'send', ['id' => 'send']);

    include_once "$fnsDir/Page/imageLink.php";
    $text = "$place->latitude, $place->longitude";
    $name = $place->name;
    if ($name !== '') $text .= " $name";
    $href = 'sms:?body='.rawurlencode($text);
    $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    $href = "../delete/$escapedItemQuery";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\staticTwoColumns($editLink, $sendLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendViaSmsLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Place Options', $content);

}
