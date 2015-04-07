<?php

namespace ViewPage;

function create ($user, $event) {

    $id = $event->id;
    $event_time = $event->event_time;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit-event/?id=$id", 'edit-event', ['id' => 'edit']);

    $href = '../new-event/?'.htmlspecialchars(http_build_query([
        'event_time' => $event_time,
        'text' => $event->text,
    ]));
    $duplicateLink = \Page\imageArrowLink('Duplicate', $href, 'duplicate-event');

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', "../delete-event/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once "$fnsDir/user_time_today.php";
    $user_time_today = user_time_today($user);

    if ($event_time == $user_time_today) {
        $calendarQuery = $newEventQuery = '';
    } else {
        $calendarQuery = '?year='.date('Y', $event_time)
            .'&amp;month='.date('n', $event_time)
            .'&amp;day='.date('j', $event_time);
        $newEventQuery = "?event_time=$event_time";
    }

    include_once __DIR__.'/viewContent.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Calendar',
                    'href' => "../$calendarQuery#$id",
                ],
            ],
            "Event #$id",
            \Page\sessionMessages('calendar/view-event/messages')
            .viewContent($event),
            \Page\newItemButton("../new-event/$newEventQuery", 'Event')
        )
        .create_panel('Event Options', $optionsContent);

}
