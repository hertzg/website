<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents) = require_event($mysqli);

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['calendar/view-event_messages']);

$page->base = '../../';
$page->title = "Delete Event #$idevents?";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'Calendar',
                'href' => '..',
            ],
        ],
        "Event #$idevents",
        Page::text('Are you sure you want to delete the event?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete event',
            "submit.php?idevents=$idevents",
            'yes'
        )
        .Page::HR
        .Page::imageLink(
            'No, return back',
            "../view-event/?idevents=$idevents",
            'no'
        )
    )
);
