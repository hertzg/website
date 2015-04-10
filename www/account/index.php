<?php

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/Form/label.php";
$items = [Form\label('Username', $user->username)];

$email = $user->email;
if ($email !== '') {
    if ($user->email_verified) {
        $emailStatus = 'Verified';
    } else {
        include_once "$fnsDir/Users/isVerifyEmailPending.php";
        if (Users\isVerifyEmailPending($user)) $emailStatus = 'Pending';
        else $emailStatus = 'Not verified';
    }
    $value = "$email ($emailStatus)";
    $items[] = Form\label('Email', $value);
}

$full_name = $user->full_name;
if ($full_name !== '') $items[] = Form\label('Full name', $full_name);

$timezone = $user->timezone;
if ($timezone) {
    include_once "$fnsDir/Timezone/format.php";
    $items[] = Form\label('Timezone', Timezone\format($timezone));
}

include_once "$fnsDir/Themes/index.php";
$items[] = Form\label('Theme', Themes\index()[$user->theme]);

include_once "$fnsDir/date_ago.php";
$items[] = Form\label('Account created', date_ago($user->insert_time, true));

include_once "$fnsDir/bytestr.php";
$items[] = Form\label('Using storage', bytestr($user->storage_used));

include_once "$fnsDir/n_times.php";
$items[] = Form\label('Signed in', ucfirst(n_times($user->num_logins)));

include_once 'fns/create_options_panel.php';
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => '../home/#account',
            ],
        ],
        'Account',
        Page\sessionMessages('account/messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Account', $content, $base);
