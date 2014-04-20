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

$birthday_time = $receivedContact->birthday_time;
if ($birthday_time !== null) {
    $items[] = Form\label('Birth date', date('F d, Y', $birthday_time));
}

$username = $receivedContact->username;
if ($username !== '') {
    $items[] = Form\label('Zvini username', htmlspecialchars($username));
}

$tags = $receivedContact->tags;
if ($tags !== '') {
    include_once '../../../fns/Page/text.php';
    $items[] = Page\text('Tags: '.htmlspecialchars($tags));
}

include_once '../../../fns/date_ago.php';
include_once '../../../fns/Page/infoText.php';
$items[] = Page\infoText(
    '<div>'
        .($receivedContact->favorite ? 'Favorite' : 'Regular').' contact.'
    .'</div>'
    .'<div>Contact received '.date_ago($receivedContact->insert_time).'.</div>'
);

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_panel.php';
include_once '../../../fns/Page/tabs.php';
$content = create_tabs(
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
    Form\label('Received from', htmlspecialchars($receivedContact->sender_username))
    .create_panel('The Contact', join('<div class="hr"></div>', $items))
    .create_options_panel($id)
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received Contact #$id", $content, '../../../');
