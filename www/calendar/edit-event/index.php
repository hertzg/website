<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents) = require_event($mysqli);

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('calendar/edit-event/index_lastpost', $_SESSION)) {
    $values = $_SESSION['calendar/edit-event/index_lastpost'];
} else {
    $values = array('eventtext' => $event->eventtext);
}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('calendar/edit-event/index_errors');

unset($_SESSION['calendar/view-event_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/label.php';

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
        .'<form action="submit.php" method="post">'
            .Form\label('When', date('F d, Y', $event->eventtime))
            .'<div class="hr"></div>'
            .Form::textfield('eventtext', 'Text', array(
                'value' => $values['eventtext'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
            .Form\hidden('idevents', $idevents)
        .'</form>'
    )
);
