<?php

include_once 'lib/require-event.php';
include_once '../fns/create_panel.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

if (array_key_exists('calendar/view-event_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['calendar/view-event_messages']);
} else {
    $pageMessages = '';
}

unset($_SESSION['calendar/index_messages']);

$page->base = '../';
$page->finish(
    Tab::create(
        Tab::item('Calendar', './')
        .Tab::activeItem('Event'),
        $pageMessages
        .Page::text(htmlspecialchars($event->eventtext))
        .Page::HR
        .Page::text(date('F d, Y', $event->eventtime))
    )
    .create_panel(
        'Options',
        Page::imageLink(
            'Edit Event',
            "edit-event.php?idevents=$idevents",
            'edit-event'
        )
        .Page::HR
        .Page::imageLink(
            'Delete Event',
            "delete-event.php?idevents=$idevents",
            'trash-bin'
        )
    )
);
