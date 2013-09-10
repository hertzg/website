<?php

include_once 'lib/require-bookmark.php';
include_once '../fns/ifset.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$lastpost = ifset($_SESSION['bookmarks/edit_lastpost']);

unset($_SESSION['bookmarks/index_messages']);

$page->base = '../';
$page->title = 'Edit Bookmark';
$page->finish(
    Tab::create(
        Tab::item('Home', '../home.php')
        .Tab::item('Bookmarks', 'index.php')
        .Tab::item('View', "view.php?id=$id")
        .Tab::activeItem('Edit')
    )
    .Page::errors(ifset($_SESSION['bookmarks/edit_errors']))
    .Form::create(
        'submit-edit.php',
        Form::textfield('url', 'URL', array(
            'value' => ifset($lastpost['url'], $bookmark->url),
            'autofocus' => true,
        ))
        .Page::HR
        .Form::textfield('title', 'Title', array(
            'value' => ifset($lastpost['title'], $bookmark->title),
        ))
        .Page::HR
        .Form::button('Save Changes')
        .Form::hidden('id', $id)
    )
);
