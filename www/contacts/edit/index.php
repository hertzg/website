<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id) = require_contact($mysqli);

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('contacts/edit_lastpost', $_SESSION)) {
    $values = $_SESSION['contacts/edit_lastpost'];
} else {
    $values = (array)$contact;
}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('contacts/edit_errors');

unset($_SESSION['contacts/view/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Edit Contact #$id";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => "Contact #$id",
                'href' => "../view/?id=$id",
            ),
        ),
        'Edit',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form::textfield('fullname', 'Full name', array(
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
        .'</form>'
    )
);
