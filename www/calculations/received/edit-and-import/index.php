<?php

$fnsDir = '../../../fns';

include_once '../fns/require_received_calculation.php';
include_once '../../../lib/mysqli.php';
list($receivedCalculation, $id, $user) = require_received_calculation(
    $mysqli, '../');

unset($_SESSION['calculations/received/view/messages']);

$key = 'calculations/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'expression',
        'expression' => $receivedCalculation->expression,
        'title' => $receivedCalculation->title,
        'tags' => $receivedCalculation->tags,
    ];
}

include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
$escapedItemQuery = ItemList\Received\escapedItemQuery($id);

include_once '../../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Received Calculation #$id",
        'href' => "../view/$escapedItemQuery#edit-and-import",
    ],
    'Edit and Import',
    Page\sessionErrors('calculations/received/edit-and-import/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Import Calculation')
        .ItemList\Received\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit and Import Received Calculation #$id",
    $content, '../../../');
