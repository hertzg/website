<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli, '../');

unset($_SESSION['notes/received/view/messages']);

$key = 'notes/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'text',
        'text' => $receivedNote->text,
        'tags' => $receivedNote->tags,
        'encrypt_in_listings' => $receivedNote->encrypt_in_listings,
        'password_protect' => false,
    ];
}

include_once "$fnsDir/Notes/maxLengths.php";
$maxLengths = Notes\maxLengths();

include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
$escapedItemQuery = ItemList\Received\escapedItemQuery($id);

include_once '../../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Received Note #$id",
        'href' => "../view/$escapedItemQuery#edit-and-import",
    ],
    'Edit and Import',
    Page\sessionErrors('notes/received/edit-and-import/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values, $scripts, '../')
        .'<div class="hr"></div>'
        .Form\button('Import Note')
        .ItemList\Received\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit and Import Received Note #$id",
    $content, '../../../', ['scripts' => $scripts]);
