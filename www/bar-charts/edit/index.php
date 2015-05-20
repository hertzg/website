<?php

include_once '../fns/require_bar_chart.php';
include_once '../../lib/mysqli.php';
list($bar_chart, $id, $user) = require_bar_chart($mysqli);

$fnsDir = '../../fns';

$key = 'bar-charts/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => $bar_chart->name];

unset($_SESSION['bar-charts/view/messages']);

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Bar Chart #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
        ],
    ],
    'Edit',
    Page\sessionErrors('bar-charts/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Edit Bar Chart #$id", $content, '../../');
