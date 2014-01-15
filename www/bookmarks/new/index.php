<?php

include_once 'lib/require-user.php';
include_once '../../classes/Form.php';
include_once '../../classes/Tab.php';
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

$page->base = '../../';
$page->title = 'New Bookmark';
$page->finish(
    Tab::create(
        Tab::item('Bookmarks', '../')
        .Tab::activeItem('New'),
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
