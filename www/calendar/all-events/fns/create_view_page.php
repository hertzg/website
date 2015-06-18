<?php

function create_view_page ($user, $event, &$scripts) {

    $id = $event->id;
    $event_time = $event->event_time;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-event', ['id' => 'edit']);

    $href = '../new/?'.htmlspecialchars(http_build_query([
        'event_time' => $event_time,
        'text' => $event->text,
    ]));
    $duplicateLink = Page\imageArrowLink('Duplicate', $href, 'duplicate-event');

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete',
                "../delete/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once "$fnsDir/user_time_today.php";
    $user_time_today = user_time_today($user);

    $newEventParams = [];
    if ($event_time != $user_time_today) {
        $newEventParams['event_time'] = $event_time;
    }

    include_once __DIR__.'/../../fns/ViewPage/viewContent.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'All Events',
                    'href' => ItemList\listHref()."#$id",
                ],
            ],
            "Event #$id",
            Page\sessionMessages('calendar/all-events/view/messages')
            .ViewPage\viewContent($event, $scripts, '../'),
            Page\newItemButton('../new/'.ItemList\escapedPageQuery($newEventParams), 'Event')
        )
        .create_panel('Event Options', $optionsContent);

}
