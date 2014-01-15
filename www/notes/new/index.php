<?php

include_once 'lib/require-user.php';
include_once '../../classes/Form.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

if (array_key_exists('notes/add_lastpost', $_SESSION)) {
    $values = $_SESSION['notes/add_lastpost'];
} else {
    $values = array(
        'notetext' => '',
        'tags' => '',
    );
}

if (array_key_exists('notes/add_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['notes/add_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['notes/index_messages']);

$page->base = '../../';
$page->title = 'New Note';
$page->finish(
    Tab::create(
        Tab::item('Notes', '../')
        .Tab::activeItem('New'),
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
            .Form::button('Save')
        )
    )
);
