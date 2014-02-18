<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id) = require_note($mysqli);

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('notes/edit_lastpost', $_SESSION)) {
    $values = $_SESSION['notes/edit_lastpost'];
} else {
    $values = (array)$note;
}

if (array_key_exists('notes/edit_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['notes/edit_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['notes/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Edit Note #$id";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => "Note #$id",
                'href' => "../view/?id=$id",
            ),
        ),
        'Edit',
        $pageErrors
        .Form::create(
            'submit.php',
            Form::textarea('notetext', 'Text', array(
                'value' => $values['notetext'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('tags', 'Tags', array(
                'value' => $values['tags'],
            ))
            .Page::HR
            .Form::button('Save Changes')
            .Form::hidden('id', $id)
        )
    )
);
