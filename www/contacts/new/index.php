<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../classes/Form.php';
include_once '../../lib/page.php';

if (array_key_exists('contacts/new/index_lastpost', $_SESSION)) {
    $values = $_SESSION['contacts/new/index_lastpost'];
} else {
    $values = array(
        'fullname' => '',
        'address' => '',
        'email' => '',
        'phone1' => '',
        'phone2' => '',
        'tags' => '',
    );
}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('contacts/new/index_errors');

unset($_SESSION['contacts/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';

$page->base = '../../';
$page->title = 'New Contact';
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
        'New',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form::textfield('fullname', 'Full name', array(
                'value' => $values['fullname'],
                'maxlength' => 32,
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form::textfield('address', 'Address', array(
                'value' => $values['address'],
                'maxlength' => 128,
            ))
            .'<div class="hr"></div>'
            .Form::textfield('email', 'Email', array(
                'value' => $values['email'],
                'maxlength' => 32,
            ))
            .'<div class="hr"></div>'
            .Form::textfield('phone1', 'Phone 1', array(
                'value' => $values['phone1'],
                'maxlength' => 32,
            ))
            .'<div class="hr"></div>'
            .Form::textfield('phone2', 'Phone 2', array(
                'value' => $values['phone2'],
                'maxlength' => 32,
            ))
            .'<div class="hr"></div>'
            .Form::textfield('tags', 'Tags', array(
                'value' => $values['tags'],
            ))
            .'<div class="hr"></div>'
            .Form\button('Save')
        .'</form>'
    )
);

