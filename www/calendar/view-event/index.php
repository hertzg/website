<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id_events, $user) = require_event($mysqli);

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
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/text.php';
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
        "Event #$id_events",
        Page\sessionMessages('calendar/view-event/messages')
        .Page\text(htmlspecialchars($event->event_text))
        .'<div class="hr"></div>'
        .Page\text(date('F d, Y', $event->event_time))
        .'<div class="hr"></div>'
        .Page\text($datesText)
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('Edit Event',
            "../edit-event/?id_events=$id_events", 'edit-event')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Delete Event',
            "../delete-event/?id_events=$id_events", 'trash-bin')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Event #$id_events", $content, '../../');
