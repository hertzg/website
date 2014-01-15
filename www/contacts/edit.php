<?php

include_once 'lib/require-contact.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

if (array_key_exists('contacts/edit_lastpost', $_SESSION)) {
    $values = $_SESSION['contacts/edit_lastpost'];
} else {
    $values = (array)$contact;
}

if (array_key_exists('contacts/edit_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['contacts/edit_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['contacts/view_messages']);

$page->base = '../';
$page->title = 'Edit Contact';
$page->finish(
    Tab::create(
        Tab::item('Contacts', './')
        .Tab::item('View', "view.php?id=$id")
        .Tab::activeItem('Edit'),
        $pageErrors
        .Form::create(
            'submit-edit.php',
            Form::textfield('fullname', 'Full name', array(
                'value' => $values['fullname'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('address', 'Address', array(
                'value' => $values['address'],
            ))
            .Page::HR
            .Form::textfield('email', 'Email', array(
                'value' => $values['email'],
            ))
            .Page::HR
            .Form::textfield('phone1', 'Phone 1', array(
                'value' => $values['phone1'],
            ))
            .Page::HR
            .Form::textfield('phone2', 'Phone 2', array(
                'value' => $values['phone2'],
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
