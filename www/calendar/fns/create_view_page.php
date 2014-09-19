<?php

function create_view_page ($event) {

    $id = $event->id;
    $fnsDir = __DIR__.'/../../fns';

    $insert_time = $event->insert_time;
    $update_time = $event->update_time;

    include_once "$fnsDir/date_ago.php";
    $datesText = '<div>Event created '.date_ago($insert_time).'.</div>';
    if ($insert_time != $update_time) {
        $datesText .= '<div>Last modified '.date_ago($update_time).'.</div>';
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit', "../edit-event/?id=$id", 'edit-event');

    $href = "../delete-event/?id=$id";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageArrowLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/text.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Calendar',
                    'href' => '..',
                ],
            ],
            "Event #$id",
            Page\sessionMessages('calendar/view-event/messages')
            .Page\text(htmlspecialchars($event->text))
            .'<div class="hr"></div>'
            .Page\text(date('F d, Y', $event->event_time))
            .Page\infoText($datesText)
        )
        .create_panel('Event Options', $optionsContent);

}
