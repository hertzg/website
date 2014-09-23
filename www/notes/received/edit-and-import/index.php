<?php

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli, '../');

unset($_SESSION['notes/received/view/messages']);

$key = 'notes/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$receivedNote;

include_once '../../../fns/Notes/maxLengths.php';
$maxLengths = Notes\maxLengths();

$base = '../../../';

include_once '../../fns/create_form_items.php';
include_once '../../../fns/compressed_js_script.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
$content =
    Page\tabs(
        [
            [
                'title' => "Received Note #$id",
                'href' => "../view/?id=$id",
            ],
        ],
        'Edit and Import',
        Page\sessionErrors('notes/received/edit-and-import/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Form\button('Import Note')
            .Form\hidden('id', $id)
        .'</form>'
    )
    .compressed_js_script('formCheckbox', $base);

include_once '../../../fns/echo_page.php';
$title = "Edit and Import Received Note #$id";
echo_page($user, $title, $content, $base);
