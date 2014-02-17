<?php

include_once __DIR__.'/../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../fns/request_strings.php';
list($idevents) = request_strings('idevents');

$idevents = abs((int)$idevents);

include_once __DIR__.'/../../fns/Events/get.php';
include_once __DIR__.'/../../lib/mysqli.php';
$event = Events\get($mysqli, $idusers, $idevents);

if (!$event) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect('..');
}

include_once '../../lib/page.php';

if (array_key_exists('calendar/view-event_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['calendar/view-event_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['calendar/edit-event_errors'],
    $_SESSION['calendar/index_messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Event #$idevents";
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
        $pageMessages
        .Page::text(htmlspecialchars($event->eventtext))
        .Page::HR
        .Page::text(date('F d, Y', $event->eventtime))
    )
    .create_panel(
        'Options',
        Page::imageLink(
            'Edit Event',
            "../edit-event/?idevents=$idevents",
            'edit-event'
        )
        .Page::HR
        .Page::imageLink(
            'Delete Event',
            "../delete-event/?idevents=$idevents",
            'trash-bin'
        )
    )
);
