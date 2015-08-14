<?php

function create_view_page ($user, &$scripts) {

    $id = $user->id_users;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/export_date_ago.php";

    $access_time = $user->access_time;
    if ($access_time === null) $accessed = 'Never';
    else {

        $accessed = export_date_ago($access_time, true);

        $access_remote_address = $user->access_remote_address;
        if ($access_remote_address !== null) {
            $accessed .= ' from '.htmlspecialchars($access_remote_address);
        }

    }

    unset(
        $_SESSION['admin/users/errors'],
        $_SESSION['admin/users/messages']
    );

    include_once "$fnsDir/bytestr.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Users',
                    'href' => "../#$id",
                ],
            ],
            "User #$id",
            Form\label('Username', htmlspecialchars($user->username))
            .'<div class="hr"></div>'
            .Form\label('Signed up', export_date_ago($user->insert_time, true))
            .'<div class="hr"></div>'
            .Form\label('Last accessed', $accessed)
            .'<div class="hr"></div>'
            .Form\label('Using storage', bytestr($user->storage_used))
        )
        .create_panel(
            'User Options',
            '<div id="deleteLink">'
                .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
            .'</div>'
        );

}
