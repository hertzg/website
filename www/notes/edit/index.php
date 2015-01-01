<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

$key = 'notes/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$note;

unset($_SESSION['notes/view/messages']);

include_once '../../fns/Notes/maxLengths.php';
$maxLengths = Notes\maxLengths();

$base = '../../';

include_once '../fns/create_form_items.php';
include_once '../../fns/compressed_js_script.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
include_once '../../fns/Page/tabs.php';
$content =
    Page\tabs(
        [
            [
                'title' => "Note #$id",
                'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
            ],
        ],
        'Edit',
        Page\sessionErrors('notes/edit/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Page\staticTwoColumns(
                Form\button('Save Changes'),
                Form\button('Send', 'sendButton')
            )
            .ItemList\itemHiddenInputs($id)
        .'</form>'
    )
    .compressed_js_script('flexTextarea', $base)
    .compressed_js_script('formCheckbox', $base);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Note #$id", $content, $base);
