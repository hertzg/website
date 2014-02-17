<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('bookmarks/new/index_lastpost', $_SESSION)) {
    $values = $_SESSION['bookmarks/new/index_lastpost'];
} else {
    $values = array(
        'url' => '',
        'title' => '',
        'tags' => '',
    );
}

if (array_key_exists('bookmarks/new/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['bookmarks/new/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['bookmarks/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = 'New Bookmark';
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'Bookmarks',
                'href' => '..',
            ],
        ],
        'New',
        $pageErrors
        .Form::create(
            'submit.php',
            Form::textfield('url', 'URL', array(
                'value' => $values['url'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('title', 'Title', array(
                'value' => $values['title'],
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
