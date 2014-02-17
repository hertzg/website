<?php

include_once 'lib/require-contact.php';
include_once '../../classes/Form.php';
include_once '../../lib/page.php';

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

unset($_SESSION['contacts/view/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Edit Contact #$id";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => "Contact #$id",
                'href' => "../view/?id=$id",
            ],
        ],
        'Edit',
        $pageErrors
        .Form::create(
            'submit.php',
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
