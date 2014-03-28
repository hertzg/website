<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

if (array_key_exists('notes/edit/values', $_SESSION)) {
    $values = $_SESSION['notes/edit/values'];
} else {
    $values = (array)$note;
}

unset(
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages']
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => "Note #$id",
                'href' => "../view/?id=$id",
            ],
        ],
        'Edit',
        Page\sessionErrors('notes/edit/errors')
        .'<form action="submit.php" method="post">'
            .Form\textarea('notetext', 'Text', [
                'value' => $values['notetext'],
                'autofocus' => true,
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('tags', 'Tags', [
                'value' => $values['tags'],
            ])
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
            .Form\hidden('id', $id)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Note #$id", $content, '../../');
