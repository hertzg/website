<?php

$fnsDir = '../../fns';

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

include_once '../fns/request_edit_event_values.php';
$values = request_edit_event_values($event, 'calendar/edit-event/values');

unset($_SESSION['calendar/view-event/messages']);

include_once "$fnsDir/Events/maxLengths.php";
$maxLengths = Events\maxLengths();

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Event #$id",
        'href' => "../view-event/?id=$id#edit",
    ],
    'Edit',
    Page\sessionErrors('calendar/edit-event/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($user, $values, $scripts)
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Event #$id", $content, '../../', [
    'scripts' => $scripts,
]);
