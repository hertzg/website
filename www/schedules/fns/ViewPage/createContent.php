<?php

namespace ViewPage;

function createContent ($id) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-schedule', ['id' => 'edit']);

    $params = [
        'text' => $text,
        'interval' => $interval,
        'offset' => $offset,
    ];
    $tags = $schedule->tags;
    if ($tags !== '') $params['tags'] = $tags;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-schedule');

    include_once "$fnsDir/Page/imageLink.php";
    $href = "../delete/$escapedItemQuery";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Schedules',
                'href' => ItemList\listHref()."#$id",
            ],
        ],
        "Schedule #$id",
        Page\sessionMessages('schedules/view/messages')
        .join('<div class="hr"></div>', $items)
        .Page\infoText($infoText)
        .create_panel(
            'Schedule Options',
            Page\staticTwoColumns($editLink, $duplicateLink)
            .'<div class="hr"></div>'
            .$deleteLink
        ),
        create_new_item_button('Schedule', '../')
    );

}
