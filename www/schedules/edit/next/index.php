<?php

include_once 'fns/require_first_stage.php';
list($user, $id, $schedule, $first_stage) = require_first_stage();

include_once '../../fns/days_left_from_today.php';
$days_left = days_left_from_today($schedule->interval, $schedule->offset);

include_once '../../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../../fns/create_offset_select.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/ItemList/listHref.php';
include_once '../../../fns/ItemList/itemHiddenInputs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../'.ItemList\listHref(),
        ],
        [
            'title' => "Schedule #$id",
            'href' => "../../view/$escapedItemQuery",
        ],
    ],
    'Edit',
    Page\imageLink('Back', "../$escapedItemQuery", 'arrow-left')
    .'<div class="hr"></div>'
    .'<form action="submit.php" method="post">'
        .create_offset_select($first_stage['interval'], $days_left)
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'New Schedule', $content, '../../../');
