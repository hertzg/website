<?php

namespace ViewPage;

function create ($user, &$scripts) {

    $id = $user->id_users;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/export_date_ago.php";

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/str_collapse_spaces.php";
    $keyword = str_collapse_spaces($keyword);

    $username = htmlspecialchars($user->username);
    if ($keyword !== '') {
        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $username = preg_replace($regex, '<mark>$0</mark>', $username);
    }

    include_once "$fnsDir/Form/label.php";
    $items = [\Form\label('Username', $username)];

    $email = $user->email;
    if ($email !== '') {
        if ($user->email_verified) $status = 'Verified';
        else {
            include_once "$fnsDir/Users/isVerifyEmailPending.php";
            if (\Users\isVerifyEmailPending($user)) $status = 'Pending';
            else $status = 'Not verified';
        }
        $items[] = \Form\label('Email', "$email ($status)");
    }

    $full_name = $user->full_name;
    if ($full_name !== '') $items[] = \Form\label('Full name', $full_name);

    $timezone = $user->timezone;
    if ($timezone) {
        include_once "$fnsDir/Timezone/format.php";
        $items[] = \Form\label('Timezone', \Timezone\format($timezone));
    }

    include_once "$fnsDir/Theme/Brightness/index.php";
    include_once "$fnsDir/Theme/Color/index.php";
    $items[] = \Form\label('Theme', \Theme\Color\index()[$user->theme_color]
        .' - '.\Theme\Brightness\index()[$user->theme_brightness]['title']);

    $access_time = $user->access_time;
    if ($access_time === null) $accessed = 'Never';
    else {

        $accessed = export_date_ago($access_time, true);

        $access_remote_address = $user->access_remote_address;
        if ($access_remote_address !== null) {
            $accessed .= ' from '.htmlspecialchars($access_remote_address);
        }

    }

    $items[] = \Form\label('Last accessed', $accessed);

    include_once "$fnsDir/bytestr.php";
    $items[] = \Form\label('Using storage', bytestr($user->storage_used));

    include_once "$fnsDir/n_times.php";
    $items[] = \Form\label('Signed in', ucfirst(n_times($user->num_signins)));

    include_once __DIR__.'/../../../fns/format_author.php';
    $author = format_author($user->insert_time, $user->insert_api_key_name);
    $infoText = '';
    if ($user->disabled) $infoText .= 'Disabled.<br />';
    if ($user->expires) {

        include_once "$fnsDir/Users/emailExpireDays.php";
        include_once "$fnsDir/Users/expireDays.php";
        $expireDays = \Users\emailExpireDays() + \Users\expireDays();

        $infoText .= "Will expires when inactive for $expireDays days.<br />";

    }
    $infoText .= "User created $author.";

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Users',
                'href' => \ItemList\listHref()."#$id",
            ],
            "User #$id",
            \Page\sessionMessages('admin/users/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('User', '../')
        )
        .optionsPanel($id);

}
