<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_unlocked_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user, $text) = require_unlocked_note($mysqli);

$key = 'notes/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'text',
        'text' => $text,
        'tags' => $note->tags,
        'encrypt_in_listings' => $note->encrypt_in_listings,
        'password_protect' => $note->password_protect,
    ];
}

unset($_SESSION['notes/view/messages']);

include_once '../../fns/Notes/maxLengths.php';
$maxLengths = Notes\maxLengths();

include_once '../fns/create_form_items.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
$content = Page\create(
    [
        'title' => "Note #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('notes/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values, $scripts)
        .Page\staticTwoColumns(
            Form\button('Save Changes'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_user_page.php';
echo_user_page($user, "Edit Note #$id",
    $content, '../../', ['scripts' => $scripts]);
