<?php

include_once 'lib/require-event.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$page->base = '../';
$page->title = 'Delete Event: '.htmlspecialchars(mb_substr($event->eventtext, 0, 20, 'UTF-8'));
$page->finish(
    Tab::create(
        Tab::item('Home', '../home.php')
        .Tab::item('Calendar', 'index.php')
        .Tab::activeItem('Event')
    )
    .Page::text('Are you sure you want to delete the event?')
    .Page::HR
    .Page::imageLink('Yes, delete event', "submit-delete-event.php?idevents=$idevents", 'yes')
    .Page::HR
    .Page::imageLink('No, return back', "view-event.php?idevents=$idevents", 'no')
);
