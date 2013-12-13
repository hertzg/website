<?php

include_once 'lib/require-contact.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$address = $contact->address;
$email = $contact->email;
$phone1 = $contact->phone1;
$phone2 = $contact->phone2;

unset(
    $_SESSION['contacts/edit_errors'],
    $_SESSION['contacts/edit_lastpost']
);

$page->base = '../';
$page->title = htmlspecialchars($contact->fullname);
$page->finish(
    Tab::create(
        Tab::item('Contacts', 'index.php')
        .Tab::activeItem('View')
    )
    .Page::messages(ifset($_SESSION['contacts/view_messages']))
    .Form::label('Full name', htmlspecialchars($contact->fullname))
    .($address ? Page::HR.Form::label('Address', htmlspecialchars($address)) : '')
    .($email ? Page::HR.Form::label('Email', htmlspecialchars($email)) : '')
    .($phone1 ? Page::HR.Form::label('Phone 1', htmlspecialchars($phone1)) : '')
    .($phone2 ? Page::HR.Form::label('Phone 2', htmlspecialchars($phone2)) : '')
    .create_panel(
        'Options',
        Page::imageLink('Edit Contact', "edit.php?id=$id", 'edit-contact')
        .Page::HR
        .Page::imageLink('Delete Contact', "delete.php?id=$id", 'trash-bin')
    )
);
