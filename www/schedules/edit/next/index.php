<?php

include_once 'fns/require_first_stage.php';
list($user, $id, $schedule, $first_stage) = require_first_stage();

$fnsDir = '../../../fns';

include_once "$fnsDir/days_left_from_today.php";
$days_left = days_left_from_today($user,
    $schedule->interval, $schedule->offset);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../../fns/create_offset_select.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Page/staticTwoColumns.php";
$content = Page\create(
    [
        'title' => "Schedule #$id",
        'href' => "../../view/$escapedItemQuery#edit",
    ],
    'Edit',
    Page\imageLink('Back', "../$escapedItemQuery", 'arrow-left')
    .'<div class="hr"></div>'
    .'<form action="submit.php" method="post">'
        .create_offset_select($user, $first_stage['interval'], $days_left)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Save'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Schedule #$id", $content, '../../../');
