<?php

include_once __DIR__.'/../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../fns/request_strings.php';
list($idevents) = request_strings('idevents');

$idevents = abs((int)$idevents);

include_once __DIR__.'/../../classes/Events.php';
$event = Events::get($idusers, $idevents);

if (!$event) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect('..');
}

include_once '../../fns/create_panel.php';
include_once '../../classes/Tab.php';
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

$page->base = '../../';
$page->title = "Event #$idevents";
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '../..')
        .Tab::item('Calendar', '..')
        .Tab::activeItem("Event #$idevents"),
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
