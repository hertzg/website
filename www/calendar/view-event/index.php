<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents) = require_event($mysqli);

include_once '../../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('calendar/view-event_messages');

unset(
    $_SESSION['calendar/edit-event/index_errors'],
    $_SESSION['calendar/edit-event/index_lastpost'],
    $_SESSION['calendar/index_messages']
);

include_once '../../fns/Page/text.php';
$text = Page\text(htmlspecialchars($event->eventtext));

$dateText = Page\text(date('F d, Y', $event->eventtime));

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageArrowLink.php';
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
        $pageMessages.$text.'<div class="hr"></div>'.$dateText
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
