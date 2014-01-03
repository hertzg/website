<?php

include_once 'lib/require-token.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

unset($_SESSION['tokens/index_messages']);

$page->base = '../';
$page->title = 'Delete Remembered Session?';
$page->finish(
    Tab::create(
        Tab::item('Account', '../account.php')
        .Tab::item('Sessions', './')
        .Tab::activeItem('View'),
        Page::text(
            'Are you sure you want to delete the remembered session'
            .' "<b>'.bin2hex($token->tokentext).'</b>"?'
        )
        .Page::HR
        .Page::imageLink(
            'Yes, delete remembered session',
            "submit-delete.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "view.php?id=$id", 'no')
    )
);
