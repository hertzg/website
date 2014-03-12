<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

unset(
    $_SESSION['contacts/edit/index_errors'],
    $_SESSION['contacts/edit/index_lastpost'],
    $_SESSION['contacts/index_errors'],
    $_SESSION['contacts/index_messages']
);

include_once '../../fns/Form/label.php';
$items = array(
    Form\label('Full name', htmlspecialchars($contact->fullname)),
);

$alias = $contact->alias;
if ($alias !== '') {
    $items[] = Form\label('Alias', htmlspecialchars($alias));
}

$address = $contact->address;
if ($address !== '') {
    $items[] = Form\label('Address', htmlspecialchars($address));
}

$email = $contact->email;
if ($email !== '') {
    $items[] = Form\label('Email', htmlspecialchars($email));
}

$phone1 = $contact->phone1;
if ($phone1 !== '') {
    $items[] = Form\label('Phone 1', htmlspecialchars($phone1));
}

$phone2 = $contact->phone2;
if ($phone2 !== '') {
    $items[] = Form\label('Phone 2', htmlspecialchars($phone2));
}

$insert_time = $contact->insert_time;
$update_time = $contact->update_time;

include_once '../../fns/ContactTags/indexOnContact.php';
$tags = ContactTags\indexOnContact($mysqli, $id);
if ($tags) {
    include_once '../../fns/create_tags.php';
    $items[] = create_tags('../', $tags);
}

include_once '../../fns/date_ago.php';
$datesText = '<div>Contact created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $datesText .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
include_once '../../fns/Page/text.php';
$items[] = Page\text($datesText);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/sessionMessages.php';
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
        Page\sessionMessages('contacts/view/index_messages')
        .join('<div class="hr"></div>', $items)
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
