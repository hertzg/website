<?php

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);

unset($_SESSION['notes/received/view/messages']);

$key = 'notes/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$receivedNote;

include_once '../../../fns/Notes/maxLengths.php';
$maxLengths = Notes\maxLengths();

$base = '../../../';

include_once '../../fns/create_form_items.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => "Received Note #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Edit and Import',
    Page\sessionErrors('notes/received/edit-and-import/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($base, $values)
        .'<div class="hr"></div>'
        .Form\button('Import Note')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Received Note #$id", $content, $base);
