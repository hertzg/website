<?php

include_once 'lib/require-bookmark.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

if (array_key_exists('bookmarks/edit_lastpost', $_SESSION)) {
    $values = $_SESSION['bookmarks/edit_lastpost'];
} else {
    $values = (array)$bookmark;
}

if (array_key_exists('bookmarks/edit_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['bookmarks/edit_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['bookmarks/index_messages']);

$page->base = '../';
$page->title = "Edit Bookmark #$id";
$page->finish(
    Tab::create(
        Tab::item('Bookmarks', './')
        .Tab::item("Bookmark #$id", "view/?id=$id")
        .Tab::activeItem('Edit'),
        $pageErrors
        .Form::create(
            'submit-edit.php',
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
            .Form::button('Save Changes')
            .Form::hidden('id', $id)
        )
    )
);
