<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/Form/label.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageArrowLinkWithDescription.php';

$full_name = $user->full_name;
if ($full_name !== '') {
    $full_name_field =
        Form\label('Full name', $full_name)
        .'<div class="hr"></div>';
} else {
    $full_name_field = '';
}

include_once '../fns/get_themes.php';
$themes = get_themes();

$emailVerifiedText = $user->email_verified ? 'Verified' : 'Not verified';
$emailValue =
    "<span>$user->email</span>"
    ."<span class=\"emailStatus\"> ($emailVerifiedText)</span>";

include_once 'fns/create_options_panel.php';
include_once '../fns/bytestr.php';
include_once '../fns/create_tabs.php';
include_once '../fns/date_ago.php';
include_once '../fns/n_times.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../home/',
            ),
        ),
        'Account',
        Page\sessionMessages('account/index_messages')
        .Form\label('Username', $user->username)
        .'<div class="hr"></div>'
        .Form\label('Email', $emailValue)
        .'<div class="hr"></div>'
        .$full_name_field
        .Form\label('Theme', $themes[$user->theme])
        .'<div class="hr"></div>'
        .Form\label('Account created', date_ago($user->insert_time))
        .'<div class="hr"></div>'
        .Form\label('Using storage', bytestr($user->storage_used))
        .'<div class="hr"></div>'
        .Form\label('Signed in', n_times($user->num_logins))
    )
    .create_options_panel($user);

include_once '../fns/echo_page.php';
echo_page($user, 'Account', $content, $base, array(
    'head' => '<link rel="stylesheet" type="text/css" href="index.css" />',
));
