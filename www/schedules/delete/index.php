<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

unset($_SESSION['schedules/view/messages']);

include_once '../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../../fns/Page/imageLink.php';
$href = "submit.php$escapedItemQuery";
$yesLink = Page\imageLink('Yes, delete schedule', $href, 'yes');

$noLink = Page\imageLink('No, return back', "../view/$escapedItemQuery", 'no');

include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Schedules',
            'href' => ItemList\listHref(),
        ],
    ],
    "Schedule #$id",
    Page\text('Are you sure you want to delete the schedule?')
    .'<div class="hr"></div>'
    .Page\twoColumns($yesLink, $noLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Schedule #$id", $content, '../../');
