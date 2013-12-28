<?php

include_once 'lib/require-note.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

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

$page->base = '../';
$page->title = 'Edit Note';
$page->finish(
    Tab::create(
        Tab::item('Notes', './')
        .Tab::item('View', "view.php?id=$id")
        .Tab::activeItem('Edit'),
        $pageErrors
        .Form::create(
            'submit-edit.php',
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
