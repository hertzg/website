<?php

namespace ViewPage;

function create ($user, $event, &$head, &$scripts) {

    $id = $event->id;
    $event_time = $event->event_time;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit-event/?id=$id", 'edit-event', ['id' => 'edit']);

    $params = [
        'event_time' => $event_time,
        'text' => $event->text,
    ];
    $start_hour = $event->start_hour;
    if ($start_hour !== null) {
        $params['start_hour'] = $start_hour;
        $params['start_minute'] = $event->start_minute;
    }
    $href = '../new-event/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-event');

    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .\Page\imageLink('Delete', "../delete-event/?id=$id",
            'trash-bin', ['id' => 'delete']);

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

    unset(
        $_SESSION['calendar/edit-event/errors'],
        $_SESSION['calendar/edit-event/values'],
        $_SESSION['calendar/errors'],
        $_SESSION['calendar/messages'],
        $_SESSION['calendar/new-event/errors'],
        $_SESSION['calendar/new-event/values']
    );

    include_once __DIR__.'/viewContent.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Calendar',
                'href' => "../$calendarQuery#$id",
            ],
            "Event #$id",
            \Page\sessionMessages('calendar/view-event/messages')
            .viewContent($event, $head, $scripts),
            \Page\newItemButton("../new-event/$newEventQuery", 'Event')
        )
        .create_panel('Event Options', $optionsContent);

}
