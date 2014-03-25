<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents, $user) = require_event($mysqli);

if (array_key_exists('calendar/edit-event/values', $_SESSION)) {
    $values = $_SESSION['calendar/edit-event/values'];
} else {
    $values = array('eventtext' => $event->eventtext);
}

unset($_SESSION['calendar/view-event/messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
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
        Page\sessionErrors('calendar/edit-event/errors')
        .'<form action="submit.php" method="post">'
            .Form\label('When', date('F d, Y', $event->eventtime))
            .'<div class="hr"></div>'
            .Form\textfield('eventtext', 'Text', array(
                'value' => $values['eventtext'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
            .Form\hidden('idevents', $idevents)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Event #$idevents", $content, '../../');
