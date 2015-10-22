<?php

namespace ViewPage;

function create ($mysqli, $apiKey, &$scripts) {

    $id = $apiKey->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'edit-api-key', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = \Page\staticTwoColumns($editLink, $deleteLink);

    include_once "$fnsDir/export_date_ago.php";
    $infoText = 'Admin API key created '
        .export_date_ago($apiKey->insert_time).'.';
    if ($apiKey->revision) {
        $infoText .= '<br />Last modified '
            .export_date_ago($apiKey->update_time).'.';
    }

    $access_time = $apiKey->access_time;
    if ($access_time === null) $accessed = 'Never';
    else {

        $accessed = export_date_ago($access_time, true);

        $access_remote_address = $apiKey->access_remote_address;
        if ($access_remote_address !== null) {
            $accessed .= ' from '.htmlspecialchars($access_remote_address);
        }

    }

    include_once "$fnsDir/create_expires_label.php";
    $expiresLabel = create_expires_label($apiKey->expire_time, $dateAgoScript);

    unset(
        $_SESSION['admin/api-keys/edit/errors'],
        $_SESSION['admin/api-keys/edit/values'],
        $_SESSION['admin/api-keys/errors'],
        $_SESSION['admin/api-keys/messages'],
        $_SESSION['admin/api-keys/new/errors'],
        $_SESSION['admin/api-keys/new/values']
    );

    include_once __DIR__.'/authsPanel.php';
    include_once __DIR__.'/createPermissionsField.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Admin API Keys',
                    'href' => "../#$id",
                ],
            ],
            "Admin API Key #$id",
            \Page\sessionMessages('admin/api-keys/view/messages')
            .\Form\label('Name', htmlspecialchars($apiKey->name))
            .'<div class="hr"></div>'
            .$expiresLabel
            .'<div class="hr"></div>'
            .\Form\textarea('key', 'Key', [
                'value' => $apiKey->key,
                'readonly' => true,
            ])
            .\Form\notes([
                'This should be the value of <code>admin_api_key</code>'
                .' parameter when calling an admin API method.',
            ])
            .'<div class="hr"></div>'
            .createPermissionsField($apiKey)
            .'<div class="hr"></div>'
            .\Form\label('Last accessed', $accessed)
            .\Page\infoText($infoText),
            \Page\newItemButton('../new/', 'Admin API Key')
        )
        .authsPanel($mysqli, $apiKey)
        .create_panel('Admin API Key Options', $optionsContent);

}
