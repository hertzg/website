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

    $items[] = Form\label('Signed up',
        export_date_ago($user->insert_time, true));

    $items[] = Form\label('Last accessed', $accessed);

    include_once "$fnsDir/bytestr.php";
    $items[] = Form\label('Using storage', bytestr($user->storage_used));

    $timezone = $user->timezone;
    if ($timezone) {
        include_once "$fnsDir/Timezone/format.php";
        $items[] = Form\label('Timezone', Timezone\format($timezone));
    }

    unset(
        $_SESSION['admin/users/errors'],
        $_SESSION['admin/users/messages']
    );

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
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
        )
        .create_panel(
            'User Options',
            '<div id="deleteLink">'
                .Page\imageLink('Delete', "../delete/$escapedItemQuery", 'trash-bin')
            .'</div>'
        );

}
