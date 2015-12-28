<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once '../../fns/request_new_event_values.php';
$values = request_new_event_values('calendar/all-events/new/values', $user);

unset(
    $_SESSION['calendar/all-events/errors'],
    $_SESSION['calendar/all-events/messages'],
    $_SESSION['calendar/all-events/view/messages']
);

include_once '../../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'All Events',
        'href' => ItemList\listHref(),
    ],
    'New Event',
    Page\sessionErrors('calendar/all-events/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($user, $values, $scripts, '../')
        .'<div class="hr"></div>'
        .Form\button('Save Event')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Event', $content, $base, ['scripts' => $scripts]);
