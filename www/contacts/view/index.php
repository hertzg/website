<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../../fns/Form/label.php';
$items = [
    Form\label('Full name', htmlspecialchars($contact->full_name)),
];

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
    $escapedEmail = htmlspecialchars($email);
    $href = "mailto:$escapedEmail";
    include_once '../../fns/Form/link.php';
    $items[] = Form\link('Email', $escapedEmail, $href, 'mail');
}

include_once 'fns/render_phone_number.php';
render_phone_number('Phone 1', $contact->phone1, $items);
render_phone_number('Phone 2', $contact->phone2, $items);

include_once '../fns/render_birthday.php';
render_birthday($contact->birthday_time, $items);

$username = $contact->username;
if ($username !== '') {
    $items[] = Form\label('Zvini username', htmlspecialchars($username));
}

$insert_time = $contact->insert_time;
$update_time = $contact->update_time;

include_once '../../fns/ContactTags/indexOnContact.php';
$tags = ContactTags\indexOnContact($mysqli, $id);
if ($tags) {
    include_once '../../fns/Page/tags.php';
    $items[] = Page\tags('../', $tags);
}

include_once '../../fns/date_ago.php';
$text =
    '<div>'.($contact->favorite ? 'Favorite' : 'Regular').' contact.</div>'
    .'<div>Contact created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
include_once '../../fns/Page/infoText.php';
$infoText = Page\infoText($text);

include_once 'fns/create_options_panel.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ],
            [
                'title' => 'Contacts',
                'href' => ItemList\listHref(),
            ],
        ],
        "Contact #$id",
        Page\sessionMessages('contacts/view/messages')
        .join('<div class="hr"></div>', $items)
        .$infoText
    )
    .create_options_panel($contact);

include_once '../../fns/echo_page.php';
echo_page($user, "Contact #$id", $content, '../../');
