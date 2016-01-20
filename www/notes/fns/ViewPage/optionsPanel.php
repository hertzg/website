<?php

namespace ViewPage;

function optionsPanel ($note, $text) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $note->id;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-note', ['id' => 'edit']);

    $params = ['text' => $text];
    $tags = $note->tags;
    if ($tags !== '') $params['tags'] = $tags;
    if ($note->encrypt_in_listings) $params['encrypt_in_listings'] = '1';
    if ($note->password_protect) $params['password_protect'] = '1';
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink('Duplicate', $href, 'duplicate-note');

    $sendLink = \Page\imageArrowLink('Send',
        "../send/$escapedItemQuery", 'send', ['id' => 'send']);

    include_once "$fnsDir/Page/imageLink.php";
    $href = 'sms:?body='.rawurlencode($text);
    $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    $historyLink = \Page\imageArrowLink('History',
        "../history/?id=$id", 'restore-defaults', ['id' => 'history']);

    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete',
                "../delete/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendLink, $sendViaSmsLink)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($historyLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Note Options', $content);

}
