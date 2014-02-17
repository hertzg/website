<?php

include_once 'lib/require-event.php';
include_once '../../classes/Form.php';
include_once '../../lib/page.php';

// TODO use $_SESSION['calendar/edit-event_errors']

unset($_SESSION['calendar/view-event_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Edit Event #$idevents";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => "Event #$idevents",
                'href' => "../view-event/?idevents=$idevents",
            ],
        ],
        'Edit',
        Form::create(
            'submit.php',
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
    )
);
