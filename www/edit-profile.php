<?php

include_once 'lib/require-user.php';
include_once 'fns/create_panel.php';
include_once 'fns/ifset.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';
include_once 'lib/themes.php';

if (array_key_exists('edit-profile_lastpost', $_SESSION)) {
    $values = (object)$_SESSION['edit-profile_lastpost'];
} else {
    $values = $user;
}

unset($_SESSION['account_messages']);

$themes_html = '';
$first = true;
foreach ($themes as $id => $theme) {
    if ($first) $first = false;
    else $themes_html .= Page::HR;
    $href = "submit-edit-theme.php?theme=$id";
    if ($id == $user->theme) {
        $theme .= ' (Active)';
    }
    $themes_html .= Page::imageLink($theme, $href, "$id-theme");
}

$page->title = 'Edit Profile';
$page->finish(
    Tab::create(
        Tab::item('Account', 'account.php')
        .Tab::activeItem('Profile'),
        Page::errors(ifset($_SESSION['edit-profile_errors']))
        .Form::create(
            'submit-edit-profile.php',
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
    .create_panel('Theme', $themes_html)
);
