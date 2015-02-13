<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once '../fns/request_new_event_values.php';
request_new_event_values('calendar/new-event/values',
    $text, $event_day, $event_month, $event_year);

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages']
);

include_once "$fnsDir/Events/maxLengths.php";
$maxLengths = Events\maxLengths();

include_once '../fns/calendar_href.php';
$calendar_href = calendar_href($event_day, $event_month, $event_year);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/datefield.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Calendar',
            'href' => "$calendar_href#new-event",
        ],
    ],
    'New Event',
    Page\sessionErrors('calendar/new-event/errors')
    .'<form action="submit.php" method="post">'
        .Form\datefield([
            'name' => 'event_day',
            'value' => $event_day,
        ],
        [
            'name' => 'event_month',
            'value' => $event_month,
        ],
        [
            'name' => 'event_year',
            'value' => $event_year,
        ], 'When', true)
        .'<div class="hr"></div>'
        .Form\textfield('text', 'Text', [
            'value' => $text,
            'maxlength' => $maxLengths['text'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Event')
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Event', $content, $base);
