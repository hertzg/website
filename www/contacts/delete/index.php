<?php

include_once 'lib/require-contact.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

unset($_SESSION['contacts/view/index_messages']);

$page->base = '../../';
$page->title = 'Delete Contact?';
$page->finish(
    Tab::create(
        Tab::item('Contacts', '../')
        .Tab::activeItem('View'),
        Page::text(
            'Are you sure you want to delete the contact'
            .' "<b>'.htmlspecialchars($contact->fullname).'</b>"?'
        )
        .Page::HR
        .Page::imageLink(
            'Yes, delete contact',
            "submit.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
