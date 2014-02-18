<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('notes/new/index_lastpost', $_SESSION)) {
    $values = $_SESSION['notes/new/index_lastpost'];
} else {
    $values = array(
        'notetext' => '',
        'tags' => '',
    );
}

if (array_key_exists('notes/new/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['notes/new/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['notes/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = 'New Note';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Notes',
                'href' => '..',
            ),
        ),
        'New',
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
