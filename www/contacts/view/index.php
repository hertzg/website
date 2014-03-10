<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

$address = $contact->address;
$email = $contact->email;
$phone1 = $contact->phone1;
$phone2 = $contact->phone2;

include_once '../../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('contacts/view/index_messages');

unset(
    $_SESSION['contacts/edit_errors'],
    $_SESSION['contacts/edit_lastpost'],
    $_SESSION['contacts/index_messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/label.php';

$items = array(
    Form\label('Full name', htmlspecialchars($contact->fullname)),
);

if ($address !== '') {
    $items[] = Form\label('Address', htmlspecialchars($address));
}

if ($email !== '') {
    $items[] = Form\label('Email', htmlspecialchars($email));
}

if ($phone1 !== '') {
    $items[] = Form\label('Phone 1', htmlspecialchars($phone1));
}

if ($phone2 !== '') {
    $items[] = Form\label('Phone 2', htmlspecialchars($phone2));
}

$insert_time = $contact->insert_time;
$update_time = $contact->update_time;

include_once '../../fns/date_ago.php';
$datesText = '<div>Contact created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $datesText .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
include_once '../../fns/Page/text.php';
$items[] = Page\text($datesText);

include_once '../../fns/Page/imageArrowLink.php';
$content =
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
        $pageMessages.join('<div class="hr"></div>', $items)
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('Edit Contact', "../edit/?id=$id", 'edit-contact')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Delete Contact',
            "../delete/?id=$id", 'trash-bin')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Contact #$id", $content, '../../');
