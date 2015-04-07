<?php

namespace ViewPage;

function optionsPanel ($place) {

    $name = $place->name;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($place->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $addPointLink = \Page\imageArrowLink('Add New Point',
        "../new-point/$escapedItemQuery", 'create-point',
        ['id' => 'new-point']);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-place', ['id' => 'edit']);

    $params = [
        'latitude' => $place->latitude,
        'longitude' => $place->longitude,
    ];
    $altitude = $place->altitude;
    if ($altitude !== null) $params['altitude'] = $altitude;
    if ($name !== '') $params['name'] = $name;
    $description = $place->description;
    if ($description !== '') $params['description'] = $description;
    $tags = $place->tags;
    if ($tags !== '') $params['tags'] = $tags;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-place');

    $sendLink = \Page\imageArrowLink('Send',
        "../send/$escapedItemQuery", 'send', ['id' => 'send']);

    include_once "$fnsDir/Page/imageLink.php";
    $text = "$place->latitude, $place->longitude";
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
        \Page\staticTwoColumns($addPointLink, $editLink)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($duplicateLink, $sendLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendViaSmsLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Place Options', $content);

}
