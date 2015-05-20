<?php

include_once '../fns/require_bar_chart.php';
include_once '../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bar_chart($mysqli);

unset($_SESSION['bar-charts/view/messages']);

include_once '../fns/request_new_bar_values.php';
$values = request_new_bar_values('bar-charts/new-bar/values');

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/create_bar_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Bar Chart #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
        ]
    ],
    'Add New Bar',
    Page\sessionErrors('bar-charts/new-bar/errors')
    .'<form action="submit.php" method="post">'
        .create_bar_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Bar')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Add New Bar to Bar Chart #$bar_chart->id", $content, $base);
