<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once '../fns/request_new_event_values.php';
$values = request_new_event_values('calendar/new-event/values', $user);

$event_day = $values['event_day'];
$event_month = $values['event_month'];
$event_year = $values['event_year'];

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages'],
    $_SESSION['home/messages']
);

include_once '../fns/calendar_href.php';
$calendar_href = calendar_href($event_day, $event_month, $event_year);

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
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
        .create_form_items($values['text'],
            $event_day, $event_month, $event_year, $scripts)
        .'<div class="hr"></div>'
        .Form\button('Save Event')
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Event', $content, $base, ['scripts' => $scripts]);
