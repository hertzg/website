<?php

namespace ViewPage;

function optionsPanel ($calculation) {

    $calculationsDir = __DIR__.'/../..';
    $fnsDir = "$calculationsDir/../fns";
    $value = $calculation->value;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($calculation->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-calculation', ['id' => 'edit']);

    $params = ['expression' => $calculation->expression];
    $title = $calculation->title;
    if ($title !== '') $params['title'] = $title;
    $tags = $calculation->tags;
    if ($tags !== '') $params['tags'] = $tags;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink('Duplicate',
        $href, 'duplicate-calculation');

    if ($value !== null) {

        $sendLink = \Page\imageArrowLink('Send',
            "../send/$escapedItemQuery", 'send', ['id' => 'send']);

        $body = "$calculation->resolved_expression = $value";
        if ($title !== '') $body = "$title\n$body";
        $href = 'sms:?body='.rawurlencode($body);
        include_once "$fnsDir/Page/imageLink.php";
        $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    }

    $href = "../delete/$escapedItemQuery";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>';
    if ($value !== null) {
        $content .= \Page\twoColumns($sendLink, $sendViaSmsLink)
            .'<div class="hr"></div>';
    }
    $content .= $deleteLink;

    include_once "$fnsDir/create_panel.php";
    return create_panel('Calculation Options', $content);

}
