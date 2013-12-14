<?php

include_once 'lib/require-user.php';
include_once '../fns/ifset.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$lastpost = ifset($_SESSION['contacts/add_lastpost']);

unset($_SESSION['contacts/index_messages']);

$page->base = '../';
$page->title = 'New Contact';
$page->finish(
    Tab::create(
        Tab::item('Contacts', 'index.php')
        .Tab::activeItem('New'),
        Page::errors(ifset($_SESSION['contacts/add_errors']))
        .Form::create(
            'submit-add.php',
            Form::textfield('fullname', 'Full name', array(
                'value' => ifset($lastpost['fullname']),
                'maxlength' => 32,
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('address', 'Address', array(
                'value' => ifset($lastpost['address']),
                'maxlength' => 128,
            ))
            .Page::HR
            .Form::textfield('email', 'Email', array(
                'value' => ifset($lastpost['email']),
                'maxlength' => 32,
            ))
            .Page::HR
            .Form::textfield('phone1', 'Phone 1', array(
                'value' => ifset($lastpost['phone1']),
                'maxlength' => 32,
            ))
            .Page::HR
            .Form::textfield('phone2', 'Phone 2', array(
                'value' => ifset($lastpost['phone2']),
                'maxlength' => 32,
            ))
            .Page::HR
            .Form::button('Save')
        )
    )
);
