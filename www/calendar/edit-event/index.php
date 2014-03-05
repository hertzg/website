<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents) = require_event($mysqli);

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('calendar/edit-event_lastpost', $_SESSION)) {
    $values = $_SESSION['calendar/edit-event_lastpost'];
} else {
    $values = array('eventtext' => $event->eventtext);
}

if (array_key_exists('calendar/edit-event_errors', $_SESSION)) {
    include_once '../../fns/Page/errors.php';
    $pageErrors = Page\errors($_SESSION['calendar/edit-event_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['calendar/view-event_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Edit Event #$idevents";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => "Event #$idevents",
                'href' => "../view-event/?idevents=$idevents",
            ),
        ),
        'Edit',
        $pageErrors
        .Form::create(
            'submit.php',
            Form::label('When', date('F d, Y', $event->eventtime))
            .Page::HR
            .Form::textfield('eventtext', 'Text', array(
                'value' => $values['eventtext'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::button('Save Changes')
            .Form::hidden('idevents', $idevents)
        )
    )
);
