<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents, $user) = require_event($mysqli);

unset(
    $_SESSION['calendar/edit-event/index_errors'],
    $_SESSION['calendar/edit-event/index_lastpost'],
    $_SESSION['calendar/index_errors'],
    $_SESSION['calendar/index_messages']
);

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
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Calendar',
                'href' => '..',
            ),
        ),
        "Event #$idevents",
        Page\sessionMessages('calendar/view-event/index_messages')
        .Page\text(htmlspecialchars($event->eventtext))
        .'<div class="hr"></div>'
        .Page\text(date('F d, Y', $event->eventtime))
        .'<div class="hr"></div>'
        .Page\text($datesText)
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('Edit Event',
            "../edit-event/?idevents=$idevents", 'edit-event')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Delete Event',
            "../delete-event/?idevents=$idevents", 'trash-bin')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Event #$idevents", $content, '../../');
