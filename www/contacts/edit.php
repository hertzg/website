<?php

include_once 'lib/require-contact.php';
include_once '../fns/ifset.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$lastpost = ifset($_SESSION['contacts/edit_lastpost']);

unset($_SESSION['contacts/index_messages']);

$page->base = '../';
$page->title = 'Edit Contact';
$page->finish(
    Tab::create(
        Tab::item('Home', '../home.php')
        .Tab::item('Contacts', 'index.php')
        .Tab::item('View', "view.php?id=$id")
        .Tab::activeItem('Edit')
    )
    .Page::errors(ifset($_SESSION['contacts/edit_errors']))
    .Form::create(
        'submit-edit.php',
        Form::textfield('fullname', 'Full name', array(
            'value' => ifset($lastpost['fullname'], $contact->fullname),
            'autofocus' => true,
            'required' => true,
        ))
        .Page::HR
        .Form::textfield('address', 'Address', array(
            'value' => ifset($lastpost['address'], $contact->address),
        ))
        .Page::HR
        .Form::textfield('email', 'Email', array(
            'value' => ifset($lastpost['email'], $contact->email),
        ))
        .Page::HR
        .Form::textfield('phone1', 'Phone 1', array(
            'value' => ifset($lastpost['phone1'], $contact->phone1),
        ))
        .Page::HR
        .Form::textfield('phone2', 'Phone 2', array(
            'value' => ifset($lastpost['phone2'], $contact->phone2),
        ))
        .Page::HR
        .Form::button('Save Changes')
        .Form::hidden('id', $id)
    )
);
