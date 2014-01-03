<?php

include_once 'lib/require-event.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

$page->base = '../';
$page->title = 'Delete Event?';
$page->finish(
    Tab::create(
        Tab::item('Calendar', './')
        .Tab::activeItem('Event'),
        Page::text('Are you sure you want to delete the event?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete event',
            "submit-delete-event.php?idevents=$idevents",
            'yes'
        )
        .Page::HR
        .Page::imageLink(
            'No, return back',
            "view-event.php?idevents=$idevents",
            'no'
        )
    )
);
