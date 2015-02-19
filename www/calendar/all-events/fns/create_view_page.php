<?php

function create_view_page ($user, $event) {

    $id = $event->id;
    $event_time = $event->event_time;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'edit-event', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    include_once "$fnsDir/user_time_today.php";
    $user_time_today = user_time_today($user);

    if ($event_time != $user_time_today) {
        $queryString = '?year='.date('Y', $event_time)
            .'&amp;month='.date('n', $event_time)
            .'&amp;day='.date('j', $event_time);
    } else {
        $queryString = '';
    }

    include_once __DIR__.'/../../fns/ViewPage/viewContent.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/text.php";
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
            Page\newItemButton("../new/$queryString", 'Event')
        )
        .create_panel('Event Options', $optionsContent);

}
