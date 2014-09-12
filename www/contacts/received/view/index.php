<?php

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

unset(
    $_SESSION['contacts/received/edit-and-import/errors'],
    $_SESSION['contacts/received/edit-and-import/values'],
    $_SESSION['contacts/received/messages']
);

include_once '../../../fns/Form/label.php';
$items = [
    Form\label('Full name', htmlspecialchars($receivedContact->full_name)),
];

$alias = $receivedContact->alias;
if ($alias !== '') {
    $items[] = Form\label('Alias', htmlspecialchars($alias));
}

$address = $receivedContact->address;
if ($address !== '') {
    $items[] = Form\label('Address', htmlspecialchars($address));
}

$email = $receivedContact->email;
if ($email !== '') {
    $escapedEmail = htmlspecialchars($email);
    $href = "mailto:$escapedEmail";
    include_once '../../../fns/Form/link.php';
    $items[] = Form\link('Email', $escapedEmail, $href, 'mail');
}

include_once '../../view/fns/render_phone_number.php';
render_phone_number('Phone 1', $receivedContact->phone1, $items);
render_phone_number('Phone 2', $receivedContact->phone2, $items);

include_once '../../fns/render_birthday.php';
render_birthday($receivedContact->birthday_time, $items, '../');

$username = $receivedContact->username;
if ($username !== '') {
    $items[] = Form\label('Zvini username', htmlspecialchars($username));
}

$base = '../../../';

$timezone = $receivedContact->timezone;
if ($timezone !== null) {
    include_once '../../../fns/Form/timezoneLabel.php';
    $items[] = Form\timezoneLabel($base, $timezone);
}

$tags = $receivedContact->tags;
if ($tags !== '') {
    include_once '../../../fns/Page/text.php';
    $items[] = Page\text('Tags: '.htmlspecialchars($tags));
}

include_once '../../../fns/date_ago.php';
include_once '../../../fns/Page/infoText.php';
$infoText = Page\infoText(
    '<div>'
        .($receivedContact->favorite ? 'Favorite' : 'Regular').' contact.'
    .'</div>'
    .'<div>Contact received '.date_ago($receivedContact->insert_time).'.</div>'
);

$contactContent = join('<div class="hr"></div>', $items);

$photoSrc = '../../../images/empty-photo.svg';

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_panel.php';
include_once '../../../fns/create_contact_panel.php';
include_once '../../../fns/Page/sessionMessages.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Received',
            'href' => '..',
        ],
    ],
    "Received Contact #$id",
    Page\sessionMessages('contacts/received/view/messages')
    .Form\label('Received from',
        htmlspecialchars($receivedContact->sender_username))
    .create_panel('The Contact', create_contact_panel($photoSrc, $contactContent))
    .$infoText
    .create_options_panel($receivedContact)
);

include_once '../../../fns/get_revision.php';
$cssRevision = get_revision('contact.compressed.css');

include_once '../../../fns/echo_page.php';
echo_page($user, "Received Contact #$id", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}contact.compressed.css?$cssRevision\" />"
]);
