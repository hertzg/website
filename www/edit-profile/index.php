<?php

include_once 'lib/require-user.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

if (array_key_exists('edit-profile/index_lastpost', $_SESSION)) {
    $values = (object)$_SESSION['edit-profile/index_lastpost'];
} else {
    $values = $user;
}

if (array_key_exists('edit-profile/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['edit-profile/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['account/index_messages']);

$page->base = '../';
$page->title = 'Edit Profile';
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '..')
        .Tab::item('Account', '../account/')
        .Tab::activeItem('Edit Profile'),
        $pageErrors
        .Form::create(
            'submit.php',
            Form::textfield('email', 'Email', array(
                'value' => $values->email,
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::textfield('fullname', 'Full name', array(
                'value' => $values->fullname,
            ))
            .Page::HR
            .Form::button('Save Changes')
        )
    )
);
