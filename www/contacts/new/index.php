<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('contacts/new/index_lastpost', $_SESSION)) {
    $values = $_SESSION['contacts/new/index_lastpost'];
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

if (array_key_exists('contacts/new/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['contacts/new/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['contacts/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = 'New Contact';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Contacts',
                'href' => '..',
            ),
        ),
        'New',
        $pageErrors
        .Form::create(
            'submit.php',
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
