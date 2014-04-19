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

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/infoText.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content =
    create_tabs(
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
        .Page\text(htmlspecialchars($event->event_text))
        .'<div class="hr"></div>'
        .Page\text(date('F d, Y', $event->event_time))
        .'<div class="hr"></div>'
        .Page\infoText($datesText)
    )
    .create_panel(
        'Event Options',
        Page\twoColumns(
            Page\imageArrowLink('Edit', "../edit-event/?id=$id", 'edit-event'),
            Page\imageArrowLink('Delete', "../delete-event/?id=$id", 'trash-bin')
        )
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Event #$id", $content, '../../');
