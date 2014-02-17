<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../classes/Form.php';
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

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Edit Profile';
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => 'Account',
                'href' => '../account/',
            ],
        ],
        'Edit Profile',
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
