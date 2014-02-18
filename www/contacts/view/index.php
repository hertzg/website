<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id) = require_contact($mysqli);

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

$address = $contact->address;
$email = $contact->email;
$phone1 = $contact->phone1;
$phone2 = $contact->phone2;

if (array_key_exists('contacts/view/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['contacts/view/index_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['contacts/edit_errors'],
    $_SESSION['contacts/edit_lastpost'],
    $_SESSION['contacts/index_messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = "Contact #$id";
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
        "Contact #$id",
        $pageMessages
        .Form::label('Full name', htmlspecialchars($contact->fullname))
        .($address ? Page::HR.Form::label('Address', htmlspecialchars($address)) : '')
        .($email ? Page::HR.Form::label('Email', htmlspecialchars($email)) : '')
        .($phone1 ? Page::HR.Form::label('Phone 1', htmlspecialchars($phone1)) : '')
        .($phone2 ? Page::HR.Form::label('Phone 2', htmlspecialchars($phone2)) : '')
    )
    .create_panel(
        'Options',
        Page::imageLink('Edit Contact', "../edit/?id=$id", 'edit-contact')
        .Page::HR
        .Page::imageLink('Delete Contact', "../delete/?id=$id", 'trash-bin')
    )
);
