<?php

include_once 'lib/require-event.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

unset($_SESSION['calendar/index_messages']);

$page->base = '../';
$page->finish(
    Tab::create(
        Tab::item('Calendar', './')
        .Tab::activeItem('Event'),
        Page::messages(ifset($_SESSION['calendar/view-event_errors']))
        .Page::text(htmlspecialchars($event->eventtext))
        .Page::HR
        .Page::text(date('F d, Y', $event->eventtime))
    )
    .create_panel(
        'Options',
        Page::imageLink('Edit Event', "edit-event.php?idevents=$idevents", 'edit-event')
        .Page::HR
        .Page::imageLink('Delete Event', "delete-event.php?idevents=$idevents", 'trash-bin')
    )
);
