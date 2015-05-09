<?php

include_once '../fns/require_bar.php';
include_once '../../lib/mysqli.php';
list($bar, $id, $user) = require_bar($mysqli);

$fnsDir = '../../fns';

include_once '../fns/request_edit_bar_values.php';
$values = request_edit_bar_values($bar, 'bar-charts/edit-bar/values');

unset($_SESSION['bar-charts/view-bar/messages']);

include_once '../fns/create_bar_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Bar #$id",
            'href' => "../view-bar/?id=$id#edit",
        ],
    ],
    'Edit',
    Page\sessionErrors('bar-charts/edit-bar/errors')
    .'<form action="submit.php" method="post">'
        .create_bar_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Edit Bar #$id", $content, '../../');
