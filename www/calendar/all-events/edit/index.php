<?php

$fnsDir = '../../../fns';

include_once '../fns/require_event.php';
include_once '../../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$key = 'calendar/all-events/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $event_time = $event->event_time;
    $values = [
        'event_day' => date('d', $event_time),
        'event_month' => date('n', $event_time),
        'event_year' => date('Y', $event_time),
        'text' => $event->text,
    ];
}

unset($_SESSION['calendar/all-events/view/messages']);

include_once "$fnsDir/Events/maxLengths.php";
$maxLengths = Events\maxLengths();

include_once '../../fns/create_form_items.php';
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/datefield.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\tabs(
    [
        [
            'title' => "Event #$id",
            'href' => "../view/?id=$id#edit",
        ],
    ],
    'Edit',
    Page\sessionErrors('calendar/all-events/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values['text'], $values['event_day'],
            $values['event_month'], $values['event_year'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Edit Event #$id", $content, '../../../');
