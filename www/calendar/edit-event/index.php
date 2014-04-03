<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$key = 'calendar/edit-event/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = ['event_text' => $event->event_text];
}

unset($_SESSION['calendar/view-event/messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
        [
            'title' => "Event #$id",
            'href' => "../view-event/?id=$id",
        ],
    ],
    'Edit',
    Page\sessionErrors('calendar/edit-event/errors')
    .'<form action="submit.php" method="post">'
        .Form\label('When', date('F d, Y', $event->event_time))
        .'<div class="hr"></div>'
        .Form\textfield('event_text', 'Text', [
            'value' => $values['event_text'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Event #$id", $content, '../../');
