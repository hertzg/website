<?php

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

$key = 'contacts/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = (array)$receivedContact;
}

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
        [
            'title' => "Received Contact #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Edit and Import',
    Page\sessionErrors('contacts/received/edit-and-import/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('full_name', 'Full name', [
            'value' => $values['full_name'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('alias', 'Alias', [
            'value' => $values['alias'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('address', 'Address', [
            'value' => $values['address'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('phone1', 'Phone 1', [
            'value' => $values['phone1'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('phone2', 'Phone 2', [
            'value' => $values['phone2'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('username', 'Zvini username', [
            'value' => $values['username'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\button('Import Contact')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Received Contact #$id", $content, '../../../');
