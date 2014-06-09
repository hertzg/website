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

include_once '../../fns/Form/button.php';
include_once '../../fns/Form/checkbox.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => ItemList\listHref(),
        ],
        [
            'title' => "Note #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
        ],
    ],
    'Edit',
    Page\sessionErrors('notes/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'encrypt',
            'Encrypt in Listings', $values['encrypt'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
//        .Page\staticTwoColumns(
//            Form\button('Save Changes'),
//            Form\button('Send', 'sendButton')
//        )
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Note #$id", $content, $base);
