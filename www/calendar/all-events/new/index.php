<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once '../../fns/request_new_event_values.php';
$values = request_new_event_values('calendar/all-events/new/values', $user);

unset(
    $_SESSION['calendar/all-events/errors'],
    $_SESSION['calendar/all-events/messages']
);

include_once '../../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'All Events',
            'href' => '..',
        ],
    ],
    'New',
    Page\sessionErrors('calendar/all-events/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values['text'], $values['event_day'],
            $values['event_month'], $values['event_year'])
        .'<div class="hr"></div>'
        .Form\button('Save Event')
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Event', $content, $base);
