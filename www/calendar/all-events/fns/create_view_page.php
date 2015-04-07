<?php

function create_view_page ($user, $event) {

    $id = $event->id;
    $event_time = $event->event_time;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'edit-event', ['id' => 'edit']);

    $href = '../new/?'.htmlspecialchars(http_build_query([
        'event_time' => $event_time,
        'text' => $event->text,
    ]));
    $duplicateLink = Page\imageArrowLink('Duplicate', $href, 'duplicate-event');

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once "$fnsDir/user_time_today.php";
    $user_time_today = user_time_today($user);

    if ($event_time == $user_time_today) $newEventQuery = '';
    else $newEventQuery = "?event_time=$event_time";

    include_once __DIR__.'/../../fns/ViewPage/viewContent.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'All Events',
                    'href' => "../#$id",
                ],
            ],
            "Event #$id",
            Page\sessionMessages('calendar/all-events/view/messages')
            .ViewPage\viewContent($event),
            Page\newItemButton("../new/$newEventQuery", 'Event')
        )
        .create_panel('Event Options', $optionsContent);

}
