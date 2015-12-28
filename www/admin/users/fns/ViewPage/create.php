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

    $access_time = $user->access_time;
    if ($access_time === null) $accessed = 'Never';
    else {

        $accessed = export_date_ago($access_time, true);

        $access_remote_address = $user->access_remote_address;
        if ($access_remote_address !== null) {
            $accessed .= ' from '.htmlspecialchars($access_remote_address);
        }

    }

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

    $items[] = \Form\label('Last accessed', $accessed);

    include_once "$fnsDir/bytestr.php";
    $items[] = \Form\label('Using storage', bytestr($user->storage_used));

    $timezone = $user->timezone;
    if ($timezone) {
        include_once "$fnsDir/Timezone/format.php";
        $items[] = \Form\label('Timezone', \Timezone\format($timezone));
    }

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
