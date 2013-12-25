<?php

include_once 'lib/require-user.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

if (array_key_exists('bookmarks/add_lastpost', $_SESSION)) {
    $values = $_SESSION['bookmarks/add_lastpost'];
} else {
    $values = array(
        'url' => '',
        'title' => '',
        'tags' => '',
    );
}

unset($_SESSION['bookmarks/index_messages']);

$page->base = '../';
$page->title = 'New Bookmark';
$page->finish(
    Tab::create(
        Tab::item('Bookmarks', './')
        .Tab::activeItem('New'),
        Page::errors(ifset($_SESSION['bookmarks/add_errors']))
        .Form::create(
            'submit-add.php',
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
