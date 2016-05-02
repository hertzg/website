<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_bar.php';
include_once '../../../lib/mysqli.php';
list($bar, $id, $user) = require_bar($mysqli, '../');

$fnsDir = '../../../fns';

include_once '../../fns/request_edit_bar_values.php';
$values = request_edit_bar_values($bar, 'bar-charts/all-bars/edit/values');

unset($_SESSION['bar-charts/all-bars/view/messages']);

include_once '../../fns/create_bar_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Bar #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('bar-charts/all-bars/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_bar_form_items($values)
        .Form\button('Save Changes')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Bar #$id", $content, '../../../');
