<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$insert_time = $event->insert_time;
$update_time = $event->update_time;

include_once '../../fns/date_ago.php';
$datesText = '<div>Event created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $datesText .= '<div>Last modified '.date_ago($update_time).'.</div>';
}

include_once '../../fns/Page/imageArrowLink.php';
$editLink = Page\imageArrowLink('Edit', "../edit-event/?id=$id", 'edit-event');

$href = "../delete-event/?id=$id";
$deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/infoText.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content =
    Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ],
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
    .create_panel('Event Options', Page\twoColumns($editLink, $deleteLink));

include_once '../../fns/echo_page.php';
echo_page($user, "Event #$id", $content, '../../');
