<?php

namespace ViewPage;

function optionsPanel ($schedule) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $schedule->id;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-schedule', ['id' => 'edit']);

    $params = [
        'text' => $schedule->text,
        'interval' => $schedule->interval,
        'offset' => $schedule->offset,
    ];
    $tags = $schedule->tags;
    if ($tags !== '') $params['tags'] = $tags;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-schedule');

    $sendLink = \Page\imageArrowLink('Send',
        "../send/$escapedItemQuery", 'send', ['id' => 'send']);

    $historyLink = \Page\imageArrowLink('History',
        "../history/?id=$id", 'restore-defaults', ['id' => 'history']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete',
                "../delete/$escapedItemQuery", 'trash-bin')
        .'</div>';

    $content =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .$sendLink
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($historyLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Schedule Options', $content);

}
