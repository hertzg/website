<?php

namespace ViewPage;

function create ($apiKey) {

    $id = $apiKey->id;
    $fnsDir = __DIR__.'/../../../../fns';

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

    $access_time = $apiKey->access_time;
    if ($access_time === null) $accessed = 'Never';
    else {

        include_once "$fnsDir/date_ago.php";
        $accessed = date_ago($access_time, true);

        $access_remote_address = $apiKey->access_remote_address;
        if ($access_remote_address !== null) {
            $accessed .= ' from '.htmlspecialchars($access_remote_address);
        }

    }

    include_once __DIR__.'/createPermissionsField.php';
    include_once __DIR__.'/../../../fns/create_expires_label.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => 'API Keys',
                'href' => "../#$id",
            ],
        ],
        "API Key #$id",
        \Page\sessionMessages('account/api-keys/view/messages')
        .\Form\label('Name', htmlspecialchars($apiKey->name))
        .'<div class="hr"></div>'
        .create_expires_label($apiKey->expire_time)
        .'<div class="hr"></div>'
        .\Form\textarea('key', 'Key', [
            'value' => $apiKey->key,
            'readonly' => true,
        ])
        .'<div class="hr"></div>'
        .createPermissionsField($apiKey)
        .'<div class="hr"></div>'
        .\Form\label('Last accessed', $accessed)
        .create_panel('API Key Options', $optionsContent),
        \Page\newItemButton('../new/', 'API Key')
    );

}
