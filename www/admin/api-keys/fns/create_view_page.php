<?php

function create_view_page ($apiKey, &$scripts) {

    $id = $apiKey->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    unset(
        $_SESSION['admin/api-keys/edit/errors'],
        $_SESSION['admin/api-keys/edit/values'],
        $_SESSION['admin/api-keys/errors'],
        $_SESSION['admin/api-keys/messages']
    );

    include_once "$fnsDir/export_date_ago.php";
    $infoText = 'Admin API key created '
        .export_date_ago($apiKey->insert_time).'.';
    if ($apiKey->revision) {
        $infoText .= '<br />Last modified '
            .export_date_ago($apiKey->update_time).'.';
    }

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Admin API Keys',
                    'href' => "../#$id",
                ],
            ],
            "Admin API Key #$id",
            Page\sessionMessages('admin/api-keys/view/messages')
            .Form\label('Name', htmlspecialchars($apiKey->name))
            .Page\infoText($infoText),
            Page\newItemButton('../new/', 'Admin API Key')
        )
        .create_panel(
            'Admin API Key Options',
            Page\staticTwoColumns(
                Page\imageArrowLink('Edit', "../edit/?id=$id",
                    'edit-api-key', ['id' => 'edit']),
                '<div id="deleteLink">'
                    .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
                .'</div>'
            )
        );

}
