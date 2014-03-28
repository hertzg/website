<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents, $user) = require_event($mysqli);

unset($_SESSION['calendar/view-event/messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
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
        "Event #$idevents",
        Page\text('Are you sure you want to delete the event?')
        .'<div class="hr"></div>'
        .Page\imageLink('Yes, delete event',
            "submit.php?idevents=$idevents", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back',
            "../view-event/?idevents=$idevents", 'no')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Event #$idevents?", $content, '../../');
