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

include_once '../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('edit-profile/index_errors');

unset($_SESSION['account/index_messages']);

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Edit Profile';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Account',
                'href' => '../account/',
            ),
        ),
        'Edit Profile',
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form::textfield('email', 'Email', array(
                'value' => $values->email,
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form::textfield('fullname', 'Full name', array(
                'value' => $values->fullname,
            ))
            .'<div class="hr"></div>'
            .Form::button('Save Changes')
        .'</form>'
    )
);
