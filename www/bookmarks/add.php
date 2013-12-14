<?php

include_once 'lib/require-user.php';
include_once '../fns/request_strings.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$lastpost = ifset($_SESSION['bookmarks/add_lastpost']);

unset($_SESSION['bookmarks/index_messages']);

$page->base = '../';
$page->title = 'New Bookmark';
$page->finish(
    Tab::create(
        Tab::item('Bookmarks', 'index.php')
        .Tab::activeItem('New'),
        Page::errors(ifset($_SESSION['bookmarks/add_errors']))
        .Form::create(
            'submit-add.php',
            Form::textfield('url', 'URL', array(
                'value' => ifset($lastpost['url']),
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('title', 'Title', array(
                'value' => ifset($lastpost['title']),
            ))
            .Page::HR
            .Form::button('Save')
        )
    )
);
