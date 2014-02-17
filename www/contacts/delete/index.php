<?php

include_once 'lib/require-contact.php';
include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['contacts/view/index_messages']);

$page->base = '../../';
$page->title = "Delete Contact #$id?";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'Contacts',
                'href' => '..',
            ],
        ],
        "Contact #$id",
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
