<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

if (array_key_exists('contacts/edit/index_values', $_SESSION)) {
    $values = $_SESSION['contacts/edit/index_values'];
} else {
    $values = (array)$contact;
}

unset($_SESSION['contacts/view/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
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
        Page\sessionErrors('contacts/edit/index_errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('full_name', 'Full name', array(
                'value' => $values['full_name'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\textfield('alias', 'Alias', array(
                'value' => $values['alias'],
            ))
            .'<div class="hr"></div>'
            .Form\textfield('address', 'Address', array(
                'value' => $values['address'],
            ))
            .'<div class="hr"></div>'
            .Form\textfield('email', 'Email', array(
                'value' => $values['email'],
            ))
            .'<div class="hr"></div>'
            .Form\textfield('phone1', 'Phone 1', array(
                'value' => $values['phone1'],
            ))
            .'<div class="hr"></div>'
            .Form\textfield('phone2', 'Phone 2', array(
                'value' => $values['phone2'],
            ))
            .'<div class="hr"></div>'
            .Form\textfield('tags', 'Tags', array(
                'value' => $values['tags'],
            ))
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
            .Form\hidden('id', $id)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Contact #$id", $content, '../../');
