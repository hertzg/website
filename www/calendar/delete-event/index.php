<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents) = require_event($mysqli);

unset($_SESSION['calendar/view-event_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text('Are you sure you want to delete the event?');

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = "Delete Event #$idevents?";
$page->finish(
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
        $question.'<div class="hr"></div>'
        .Page::imageLink('Yes, delete event',
            "submit.php?idevents=$idevents", 'yes')
        .'<div class="hr"></div>'
        .Page::imageLink('No, return back',
            "../view-event/?idevents=$idevents", 'no')
    )
);
