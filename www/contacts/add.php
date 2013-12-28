<?php

include_once 'lib/require-user.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

if (array_key_exists('contacts/add_lastpost', $_SESSION)) {
    $values = $_SESSION['contacts/add_lastpost'];
} else {
    $values = array(
        'fullname' => '',
        'address' => '',
        'email' => '',
        'phone1' => '',
        'phone2' => '',
        'tags' => '',
    );
}

if (array_key_exists('contacts/add_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['contacts/add_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['contacts/index_messages']);

$page->base = '../';
$page->title = 'New Contact';
$page->finish(
    Tab::create(
        Tab::item('Contacts', './')
        .Tab::activeItem('New'),
        $pageErrors
        .Form::create(
            'submit-add.php',
            Form::textfield('fullname', 'Full name', array(
                'value' => $values['fullname'],
                'maxlength' => 32,
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('address', 'Address', array(
                'value' => $values['address'],
                'maxlength' => 128,
            ))
            .Page::HR
            .Form::textfield('email', 'Email', array(
                'value' => $values['email'],
                'maxlength' => 32,
            ))
            .Page::HR
            .Form::textfield('phone1', 'Phone 1', array(
                'value' => $values['phone1'],
                'maxlength' => 32,
            ))
            .Page::HR
            .Form::textfield('phone2', 'Phone 2', array(
                'value' => $values['phone2'],
                'maxlength' => 32,
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
