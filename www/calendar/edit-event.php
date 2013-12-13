<?php

include_once 'lib/require-event.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

unset($_SESSION['calendar/view-event_errors']);

$page->base = '../';
$page->finish(
    Tab::create(
        Tab::item('Calendar', 'index.php')
        .Tab::item('Event', "view-event.php?idevents=$idevents")
        .Tab::activeItem('Edit')
    )
    .Form::create(
        'submit-edit-event.php',
        Form::label('When', date('F d, Y', $event->eventtime))
        .Page::HR
        .Form::textfield('eventtext', 'Text', array(
            'value' => $event->eventtext,
            'autofocus' => true,
            'required' => true,
        ))
        .Page::HR
        .Form::button('Save Changes')
        .Form::hidden('idevents', $idevents)
    )
);
