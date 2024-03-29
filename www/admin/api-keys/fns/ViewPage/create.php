<?php

namespace ViewPage;

function create ($mysqli, $apiKey, &$scripts) {

    $id = $apiKey->id;
    $base = '../../../';
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base)
        .compressed_js_script('flexTextarea', $base);

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/parse_keyword.php";
    parse_keyword($keyword, $includes, $excludes);

    $name = htmlspecialchars($apiKey->name);
    if ($includes) {
        include_once "$fnsDir/keyword_regex.php";
        $regex = keyword_regex($includes);
        $name = preg_replace($regex, '<mark>$0</mark>', $name);
    }

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

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once __DIR__.'/authsPanel.php';
    include_once __DIR__.'/createPermissionsField.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_expires_label.php";
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Admin API Keys',
                'href' => \ItemList\listHref()."#$id",
            ],
            "Admin API Key #$id",
            \Page\sessionMessages('admin/api-keys/view/messages')
            .\Form\label('Name', $name)
            .'<div class="hr"></div>'
            .create_expires_label($apiKey->expire_time)
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
            create_new_item_button('Admin API Key', '../')
        )
        .authsPanel($mysqli, $apiKey, $scripts)
        .optionsPanel($id);

}
