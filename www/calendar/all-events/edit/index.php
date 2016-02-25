<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once '../fns/require_event.php';
include_once '../../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

include_once '../../fns/request_edit_event_values.php';
$values = request_edit_event_values($event, 'calendar/all-events/edit/values');

unset($_SESSION['calendar/all-events/view/messages']);

include_once "$fnsDir/Events/maxLengths.php";
$maxLengths = Events\maxLengths();

include_once '../../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Event #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('calendar/all-events/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($user, $values, $scripts, '../')
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Event #$id", $content, '../../../', [
    'scripts' => $scripts,
]);
