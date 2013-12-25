<?php

include_once 'lib/require-user.php';
include_once '../fns/ifset.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

if (array_key_exists('notes/add_lastpost', $_SESSION)) {
    $values = $_SESSION['notes/add_lastpost'];
} else {
    $values = array(
        'notetext' => '',
        'tags' => '',
    );
}

unset($_SESSION['notes/index_messages']);

$page->base = '../';
$page->title = 'New Note';
$page->finish(
    Tab::create(
        Tab::item('Notes', './')
        .Tab::activeItem('New'),
        Page::errors(ifset($_SESSION['notes/add_errors']))
        .Form::create(
            'submit-add.php',
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
            .Form::button('Save')
        )
    )
);
