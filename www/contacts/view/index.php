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
    include_once '../../fns/Page/messages.php';
    $pageMessages = Page\messages($_SESSION['contacts/view/index_messages']);
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

$items = array(
    Form::label('Full name', htmlspecialchars($contact->fullname)),
);

if ($address !== '') {
    $items[] = Form::label('Address', htmlspecialchars($address));
}

if ($email !== '') {
    $items[] = Form::label('Email', htmlspecialchars($email));
}

if ($phone1 !== '') {
    $items[] = Form::label('Phone 1', htmlspecialchars($phone1));
}

if ($phone2 !== '') {
    $items[] = Form::label('Phone 2', htmlspecialchars($phone2));
}

$insert_time = $contact->insert_time;
$update_time = $contact->update_time;

include_once '../../fns/date_ago.php';
$infoText = '<div>Contact created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $infoText .= '<div>Last modified '.date_ago($update_time).'.</div>';
}

$items[] = Page::text($infoText);

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
        $pageMessages.join(Page::HR, $items)
    )
    .create_panel(
        'Options',
        Page::imageArrowLink('Edit Contact', "../edit/?id=$id", 'edit-contact')
        .Page::HR
        .Page::imageArrowLink('Delete Contact',
            "../delete/?id=$id", 'trash-bin')
    )
);
