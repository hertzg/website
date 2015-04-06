<?php

namespace ViewPage;

function optionsPanel ($bookmark) {

    $bookmarksDir = __DIR__.'/../..';
    $fnsDir = "$bookmarksDir/../fns";
    $url = $bookmark->url;

    include_once "$bookmarksDir/fns/create_open_links.php";
    $values = create_open_links($url, '../../');
    list($openLink, $openInNewTabLink) = $values;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($bookmark->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-bookmark', ['id' => 'edit']);

    $params = ['url' => $url];
    $title = $bookmark->title;
    if ($title !== '') $params['title'] = $title;
    $tags = $bookmark->tags;
    if ($tags !== '') $params['tags'] = $tags;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink('Duplicate',
        $href, 'duplicate-bookmark');

    $sendLink = \Page\imageArrowLink('Send',
        "../send/$escapedItemQuery", 'send', ['id' => 'send']);

    include_once "$fnsDir/Page/imageLink.php";
    $href = 'sms:?body='.rawurlencode($url);
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
        .\Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendLink, $sendViaSmsLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once "$fnsDir/create_panel.php";
    return create_panel('Bookmark Options', $content);

}
