<?php

function create_view_page ($event) {

    $id = $event->id;
    $fnsDir = __DIR__.'/../../fns';

    $insert_time = $event->insert_time;
    $update_time = $event->update_time;

    include_once "$fnsDir/format_author.php";
    $author = format_author($insert_time, $event->insert_api_key_name);
    $infoText = "Event created $author.";
    if ($insert_time != $update_time) {
        $author = format_author($update_time, $event->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../edit-event/?id=$id";
    $editLink = Page\imageArrowLink('Edit', $href, 'edit-event');

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', "../delete-event/?id=$id", 'trash-bin')
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
            .Page\infoText($infoText)
        )
        .create_panel('Event Options', $optionsContent);

}
