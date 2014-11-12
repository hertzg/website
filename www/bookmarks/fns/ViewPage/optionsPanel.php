<?php

namespace ViewPage;

function optionsPanel ($bookmark) {

    $bookmarksDir = __DIR__.'/../..';
    $fnsDir = "$bookmarksDir/../fns";

    include_once "$bookmarksDir/fns/create_open_links.php";
    $values = create_open_links($bookmark->url, '../../');
    list($openLink, $openInNewTabLink) = $values;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($bookmark->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../edit/$escapedItemQuery";
    $editLink = \Page\imageArrowLink('Edit', $href, 'edit-bookmark');

    $href = "../send/$escapedItemQuery";
    $sendLink = \Page\imageArrowLink('Send', $href, 'send');

    include_once "$fnsDir/Page/imageLink.php";
    $href = 'sms:?body='.rawurlencode($bookmark->url);
    $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    $href = "../delete/$escapedItemQuery";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\twoColumns($openLink, $openInNewTabLink)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($editLink, $sendLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendViaSmsLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Bookmark Options', $content);

}
