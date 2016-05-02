<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once '../fns/request_new_event_values.php';
$values = request_new_event_values('calendar/new-event/values', $user);

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages'],
    $_SESSION['calendar/view-event/messages'],
    $_SESSION['home/messages']
);

include_once '../fns/calendar_href.php';
$calendar_href = calendar_href($values['event_day'],
    $values['event_month'], $values['event_year']);

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Calendar',
        'href' => "$calendar_href#new-event",
    ],
    'New Event',
    Page\sessionErrors('calendar/new-event/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($user, $values, $scripts)
        .Form\button('Save Event')
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Event', $content, $base, ['scripts' => $scripts]);
