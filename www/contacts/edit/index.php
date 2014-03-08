<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id) = require_contact($mysqli);

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
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
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
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\textfield('fullname', 'Full name', array(
                'value' => $values['fullname'],
                'autofocus' => true,
                'required' => true,
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
