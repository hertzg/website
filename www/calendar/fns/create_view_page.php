<?php

function create_view_page ($user, $event) {

    $id = $event->id;
    $event_time = $event->event_time;
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/format_author.php";
    $author = format_author($event->insert_time, $event->insert_api_key_name);
    $infoText = "Event created $author.";
    if ($event->revision) {
        $api_key_name = $event->update_api_key_name;
        $author = format_author($event->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit-event/?id=$id", 'edit-event', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', "../delete-event/?id=$id", 'trash-bin')
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
                    'title' => 'Calendar',
                    'href' => "../$queryString#$id",
                ],
            ],
            "Event #$id",
            Page\sessionMessages('calendar/view-event/messages')
            .Page\text(htmlspecialchars($event->text))
            .'<div class="hr"></div>'
            .Page\text(date('F d, Y', $event_time))
            .Page\infoText($infoText),
            Page\newItemButton("../new-event/$queryString", 'Event')
        )
        .create_panel('Event Options', $optionsContent);

}
