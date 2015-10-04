<?php

function create_view_page ($user, &$scripts) {

    $id = $user->id_users;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/export_date_ago.php";

    include_once "$fnsDir/Form/label.php";
    $items = [Form\label('Username', htmlspecialchars($user->username))];

    $access_time = $user->access_time;
    if ($access_time === null) $accessed = 'Never';
    else {

        $accessed = export_date_ago($access_time, true);

        $access_remote_address = $user->access_remote_address;
        if ($access_remote_address !== null) {
            $accessed .= ' from '.htmlspecialchars($access_remote_address);
        }

    }

    include_once __DIR__.'/../../fns/format_author.php';
    $author = format_author($user->insert_time, $user->insert_api_key_name);
    $infoText = "User created $author.";

    $items[] = Form\label('Last accessed', $accessed);

    include_once "$fnsDir/bytestr.php";
    $items[] = Form\label('Using storage', bytestr($user->storage_used));

    $timezone = $user->timezone;
    if ($timezone) {
        include_once "$fnsDir/Timezone/format.php";
        $items[] = Form\label('Timezone', Timezone\format($timezone));
    }

    unset(
        $_SESSION['admin/users/edit-profile/errors'],
        $_SESSION['admin/users/edit-profile/values'],
        $_SESSION['admin/users/errors'],
        $_SESSION['admin/users/messages'],
        $_SESSION['admin/users/new/errors'],
        $_SESSION['admin/users/new/values'],
        $_SESSION['admin/users/reset-password/errors'],
        $_SESSION['admin/users/reset-password/values']
    );

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/twoColumns.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Users',
                    'href' => ItemList\listHref()."#$id",
                ],
            ],
            "User #$id",
            Page\sessionMessages('admin/users/view/messages')
            .join('<div class="hr"></div>', $items)
            .Page\infoText($infoText),
            create_new_item_button('User', '../')
        )
        .create_panel(
            'User Options',
            Page\twoColumns(
                Page\imageArrowLink('Reset Password',
                    "../reset-password/$escapedItemQuery",
                    'reset-password', ['id' => 'reset-password']),
                Page\imageArrowLink('Edit Profile',
                    "../edit-profile/$escapedItemQuery",
                    'edit-profile', ['id' => 'edit-profile'])
            )
            .'<div class="hr"></div>'
            .'<div id="deleteLink">'
                .Page\imageLink('Delete',
                    "../delete/$escapedItemQuery", 'trash-bin')
            .'</div>'
        );

}
