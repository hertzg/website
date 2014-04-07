<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$key = 'calendar/edit-event/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $event_time = $event->event_time;
    $values = [
        'event_day' => date('d', $event_time),
        'event_month' => date('n', $event_time),
        'event_year' => date('Y', $event_time),
        'event_text' => $event->event_text,
    ];
}

unset($_SESSION['calendar/view-event/messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/datefield.php';
include_once '../../fns/Form/hidden.php';
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
        .Form\datefield([
            'name' => 'event_day',
            'value' => $values['event_day'],
        ],
        [
            'name' => 'event_month',
            'value' => $values['event_month'],
        ],
        [
            'name' => 'event_year',
            'value' => $values['event_year'],
        ], 'When', true)
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
